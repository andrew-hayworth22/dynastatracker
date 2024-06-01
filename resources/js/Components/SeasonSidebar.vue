<script setup>
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputSelect from "@/Components/InputSelect.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Slideout from "@/Components/Sidebar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";

const props = defineProps({
    open: {
        type: Boolean,
        required: true,
    },
    dynastyId: {
        type: Number,
        required: true,
    },
    teams: {
        type: Array,
        required: true
    },
    coachTypes: {
        type: Array,
        required: true
    }
});

const emit = defineEmits(['close']);

const form = useForm({
    year: null,
    coach_type: null,
    team_id: null,
})

const createSeason = () => {
    form.post(route('dynasties.seasons.store', props.dynastyId), {
        onSuccess: () => {
            closeSidebar()
        }
    })
}

const closeSidebar = () => {
    form.reset()
    emit('close')
};
</script>

<template>
    <Slideout :open="open" @close="closeSidebar">
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
                        {{ team.college_name }}
                    </option>
                </InputSelect>
                <InputError :message="form.errors.team_id" class="mt-2" />
            </div>

            <div class="flex gap-4">
                <PrimaryButton :disabled="form.processing">
                    Create
                </PrimaryButton>
                <SecondaryButton @click="closeSidebar">
                    Cancel
                </SecondaryButton>
            </div>
        </form>
    </Slideout>
</template>
