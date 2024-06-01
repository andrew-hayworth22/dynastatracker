<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import InputSelect from "@/Components/InputSelect.vue";

const props = defineProps({
    dynasty: {
        type: Object,
        required: true
    },
    teams: {
        type: Array,
        required: true
    }
})

const coachTypes = [
    'OC',
    'DC',
    'HC',
]

const form = useForm({
    year: null,
    coach_type: null,
    team_id: null,
})

const createSeason = () => {
    form.post(route('dynasties.seasons.store', props.dynasty.id))
}
</script>

<template>
    <AppLayout title="Create Season">
        <DynastyHeader :dynasty="dynasty" />

        <form @submit.prevent="createSeason" class="flex flex-col gap-6 sm:w-1/2">
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

            <div>
                <PrimaryButton :disabled="form.processing">
                    Create
                </PrimaryButton>
            </div>
        </form>
    </AppLayout>
</template>
