<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";
import EmptyState from "@/Components/EmptyState.vue";
import ListItem from "@/Components/ListItem.vue";
import {Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
import Slideout from "@/Components/Slideout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputSelect from "@/Components/InputSelect.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    dynasty: {
        type: Object,
        required: true,
    },
    seasons: {
        type: Array,
        required: true,
    },
    teams: {
        type: Array,
        required: true
    }
});

const coachTypes = [
    'OC',
    'DC',
    'HC',
]

const showSlideout = ref(false);
const form = useForm({
    year: null,
    coach_type: null,
    team_id: null,
})

const createSeason = () => {
    form.post(route('dynasties.seasons.store', props.dynasty.id), {
        onSuccess: () => {
            closeSlideout()
        }
    })
}

const closeSlideout = () => {
    form.reset()
    showSlideout.value = false
};
</script>

<template>
    <AppLayout :title="`${dynasty.name} Seasons`">
        <DynastyHeader :dynasty="dynasty" />

        <template v-if="seasons.length > 0">
            <ul role="list" class="divide-y divide-gray-100">
                <ListItem v-for="season in seasons" :key="season.id" class="last-of-type:rounded-b-md">
                    <template #title>
                        <Link :href="route('seasons.show', season.id)">
                            {{ season.year + ' (' + season.record + ')' }}
                        </Link>
                    </template>
                    <template #subtitle>
                        {{ season.coach_type + " at " + season.team.college_abbreviation }}
                    </template>
                </ListItem>
            </ul>
            <PrimaryButton @click="showSlideout = true" class="mt-6">
                Create Season
            </PrimaryButton>
        </template>
        <EmptyState v-else>
            <template #title>
                No seasons
            </template>
            <template #body>
                Get started by creating your first season!
            </template>
            <template #actions>
                <PrimaryButton @click="showSlideout = true">
                    Create Season
                </PrimaryButton>
            </template>
        </EmptyState>

        <Slideout :open="showSlideout" @close="closeSlideout">
            <template #title>
                Create Season
            </template>

            <form @submit.prevent="createSeason" class="flex flex-col gap-6">
                <div>
                    <InputLabel for="year">
                        Year
                    </InputLabel>
                    <TextInput
                        id="year"
                        v-model="form.year"
                        type="number"
                        class="mt-1 block w-full"
                        :has-errors="form.errors.year !== undefined"
                    />
                    <InputError :message="form.errors.year" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="coach_type">
                        Coach Type
                    </InputLabel>
                    <InputSelect v-model="form.coach_type" id="coach_type">
                        <option :value="null">Select coach type...</option>
                        <option v-for="type in coachTypes" :key="type"
                                :value="type">
                            {{ type }}
                        </option>
                    </InputSelect>
                    <InputError :message="form.errors.coach_type" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="team">
                        Team
                    </InputLabel>
                    <InputSelect v-model="form.team_id" id="team">
                        <option :value="null">Select a team...</option>
                        <option v-for="team in teams" :key="team.id"
                                :value="team.id">
                            {{ team.college_abbreviation }}
                        </option>
                    </InputSelect>
                    <InputError :message="form.errors.team_id" class="mt-2" />
                </div>

                <div class="flex gap-4">
                    <PrimaryButton :disabled="form.processing">
                        Create
                    </PrimaryButton>
                    <SecondaryButton @click="closeSlideout">
                        Cancel
                    </SecondaryButton>
                </div>
            </form>
        </Slideout>
    </AppLayout>
</template>
