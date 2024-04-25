<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";
import EmptyState from "@/Components/EmptyState.vue";
import {useForm} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import Slideout from "@/Components/Slideout.vue";
import {gitref} from "vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import FilterBar from "@/Pages/Players/FilterBar.vue";
import Checkbox from "@/Components/Checkbox.vue";

const props = defineProps({
    dynasty: {
        type: Object,
        required: true,
    },
    players: {
        type: Object,
        required: true,
    },
    filter: {
        type: Object,
        required: true
    },
});

const showSlideout = ref(false);
const playerId = ref(null);
const playerName = ref('');
const playerForm = useForm({
    first_name: null,
    last_name: null,
    height_ft: null,
    height_in: null,
    weight_lbs: null,
    reason_left: null,
    is_active: true,
});

const editPlayer = function(player) {
    playerId.value = player.id;
    playerName.value = player.first_name + " " + player.last_name;
    playerForm.first_name = player.first_name;
    playerForm.last_name = player.last_name;
    playerForm.height_ft = player.height_ft;
    playerForm.height_in = player.height_in;
    playerForm.weight_lbs = player.weight_lbs;
    playerForm.reason_left = player.reason_left;
    playerForm.is_active = Boolean(player.is_active);
    showSlideout.value = true;
}

const closeSidebar = function() {
    playerId.value = null;
    playerName.value = '';
    playerForm.reset();

    showSlideout.value = false;
}

const savePlayer = function() {
    if(playerId.value) {
        playerForm.put(route('players.update', playerId.value), {
            preserveScroll: true,
            onSuccess: closeSidebar,
        });
        return;
    }

    playerForm.post(route('dynasties.players.store', props.dynasty.id), {
        preserveScroll: true,
        onSuccess: closeSidebar,
    });
}

</script>

<template>
    <AppLayout :title="`${dynasty.name} Players`">
        <DynastyHeader :dynasty="dynasty" />

        <template v-if="players.data.length > 0">
            <div class="flex mb-4 justify-between">
                <FilterBar field="is_active"
                           :values="['Active', 'Inactive', 'All']"
                           :filter="filter"
                           :only="['players']"
                           :url="route('dynasties.players.index', dynasty.id)"
                />
                <PrimaryButton @click="showSlideout = true">
                    Create Player
                </PrimaryButton>
            </div>
            <div class="flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-t-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Height</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Weight</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Reason Left</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="player in players.data" :key="player.id">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ player.first_name + " " + player.last_name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ player.height_ft + "' " + player.height_in + '"' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ player.weight_lbs + " lbs" }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ player.reason_left }}</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <button @click="editPlayer(player)" class="text-indigo-600 hover:text-indigo-900">
                                            Edit <span class="sr-only">, {{ player.first_name + " " + player.last_name }}</span>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <Pagination :meta="players.meta" :only="['players']" :filter="filter"/>
        </template>
        <EmptyState v-else>
            <template #title>
                No players
            </template>
            <template #body>
                Get started by creating your first player!
            </template>
            <template #actions>
                <PrimaryButton @click="showSlideout = true">
                    Create Player
                </PrimaryButton>
            </template>
        </EmptyState>

        <Slideout :open="showSlideout" @close="closeSidebar">
            <template #title>
                {{ playerId ? `Edit ${playerName}` : 'Create Player' }}
            </template>

            <form @submit.prevent="savePlayer" class="flex flex-col gap-6">
                <div>
                    <InputLabel for="first_name">
                        First Name
                    </InputLabel>
                    <TextInput
                        id="first_name"
                        v-model="playerForm.first_name"
                        type="text"
                        class="mt-1 block w-full"
                        :has-errors="playerForm.errors.first_name !== undefined"
                    />
                    <InputError :message="playerForm.errors.first_name" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="last_name">
                        Last Name
                    </InputLabel>
                    <TextInput
                        id="last_name"
                        v-model="playerForm.last_name"
                        type="text"
                        class="mt-1 block w-full"
                        :has-errors="playerForm.errors.last_name !== undefined"
                    />
                    <InputError :message="playerForm.errors.last_name" class="mt-2" />
                </div>

                <div class="flex flex-col gap-6 sm:flex-row sm:gap-3">
                    <div>
                        <InputLabel for="height_ft">
                            Height (ft)
                        </InputLabel>
                        <TextInput
                            id="height_ft"
                            v-model="playerForm.height_ft"
                            type="number"
                            class="mt-1 block w-full"
                            :has-errors="playerForm.errors.height_ft !== undefined"
                        />
                        <InputError :message="playerForm.errors.height_ft" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="height_in">
                            Height (in)
                        </InputLabel>
                        <TextInput
                            id="height_in"
                            v-model="playerForm.height_in"
                            type="number"
                            class="mt-1 block w-full"
                            :has-errors="playerForm.errors.height_in !== undefined"
                        />
                        <InputError :message="playerForm.errors.height_in" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="weight_lbs">
                            Weight (lbs)
                        </InputLabel>
                        <TextInput
                            id="weight_lbs"
                            v-model="playerForm.weight_lbs"
                            type="number"
                            class="mt-1 block w-full"
                            :has-errors="playerForm.errors.weight_lbs !== undefined"
                        />
                        <InputError :message="playerForm.errors.weight_lbs" class="mt-2" />
                    </div>
                </div>

                <template v-if="playerId">
                    <div>
                        <InputLabel for="reason_left">
                            Reason Left
                        </InputLabel>
                        <TextInput
                            id="reason_left"
                            v-model="playerForm.reason_left"
                            type="text"
                            class="mt-1 block w-full"
                            :has-errors="playerForm.errors.reason_left !== undefined"
                        />
                        <InputError :message="playerForm.errors.reason_left" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="is_active">
                            Is Active
                        </InputLabel>
                        <Checkbox
                            id="is_active"
                            v-model:checked="playerForm.is_active"
                        />
                        <InputError :message="playerForm.errors.is_active" class="mt-2" />
                    </div>
                </template>


                <div class="flex gap-4">
                    <PrimaryButton :disabled="playerForm.processing">
                        {{ playerId ? 'Save' : 'Create' }}
                    </PrimaryButton>
                    <SecondaryButton type="button" @click.prevent="closeSidebar">
                        Cancel
                    </SecondaryButton>
                </div>
            </form>
        </Slideout>
    </AppLayout>
</template>
