<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Card from "@/Components/Card.vue";
import Slideout from "@/Components/Slideout.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";
import EmptyState from "@/Components/EmptyState.vue";

const props = defineProps({
    dynasty: {
        type: Object,
        required: true,
    },
    conferences: {
        type: Array,
        required: true,
    },
});

let showConferenceForm = ref(false);

const conferenceForm = useForm({
    name: "",
    abbreviation: ""
});

const createConference = () => {
    conferenceForm.post(route("dynasties.conferences.store", props.dynasty.id), {
        onSuccess: () => {
            showConferenceForm.value = false;
            conferenceForm.reset();
        },
        preserveScroll: true,
    });
};

const cancelConferenceForm = () => {
    showConferenceForm.value = false;
    conferenceForm.reset();
};

const conferenceId = ref(null);
const divisionForm = useForm({
    name: ""
});

const cancelDivisionForm = () => {
    conferenceId.value = null;
    divisionForm.reset();
};

const createDivision = () => {
    divisionForm.post(route("conferences.divisions.store", conferenceId.value), {
        onSuccess: () => {
            conferenceId.value = null;
            divisionForm.reset();
        },
        preserveScroll: true,
    });
};

const divisionId = ref(null);
const teamForm = useForm({
    college_name: "",
    college_abbreviation: "",
    mascot: "",
    location: ""
});

const cancelTeamForm = () => {
    divisionId.value = null;
    teamForm.reset();
};

const createTeam = () => {
    teamForm.post(route("divisions.teams.store", divisionId.value), {
        onSuccess: () => {
            divisionId.value = null;
            teamForm.reset();
        },
        onError: () => {
            console.log(teamForm.errors);
        },
        preserveScroll: true,
    });
};

const show = ref(false)

</script>

<template>
    <AppLayout :title="`${dynasty.name} Teams`">
        <DynastyHeader :dynasty="dynasty" />

        <ul v-if="conferences.length > 0" class="flex flex-col gap-6">
            <li v-for="conference in conferences" :key="conference.id">
                <Card>
                    <template #title>
                        {{ conference.name }}
                    </template>

                    <template #actions>
                        <PrimaryButton type="button"
                                       @click.prevent="conferenceId = conference.id">
                            Create Division
                        </PrimaryButton>
                    </template>

                    <ul v-if="conference.divisions.length > 0" class="grid sm:grid-cols-2 gap-6 mb-2">
                        <li v-for="division in conference.divisions"
                            :key="division.id"
                            class="col-span-1">
                            <h3 class="font-semibold">
                                {{ conference.abbreviation + " " + division.name }}
                            </h3>
                            <ul class="mb-1">
                                <li v-for="team in division.teams" :key="team.id">
                                    {{ team.college_abbreviation + " " + team.mascot }}
                                </li>
                            </ul>
                            <PrimaryButton size="xs"
                                           type="button"
                                           @click.prevent="divisionId = division.id">
                                Create Team
                            </PrimaryButton>
                        </li>
                    </ul>
                    <EmptyState v-else>
                        <template #title>
                            No Divisions
                        </template>
                        <template #body>
                            Get started by creating a division!
                        </template>
                    </EmptyState>
                </Card>

            </li>
        </ul>
        <EmptyState v-else>
            <template #title>
                No conferences
            </template>
            <template #body>
                Get started by creating a conference!
            </template>
            <template #actions>
                <PrimaryButton type="button"
                               @click.prevent="showConferenceForm = true">
                    Create Conference
                </PrimaryButton>
            </template>
        </EmptyState>

        <div v-if="conferences.length > 0" class="mt-6">
            <PrimaryButton type="button"
                           @click.prevent="showConferenceForm = true">
                Create Conference
            </PrimaryButton>
        </div>

        <Slideout :open="divisionId !== null" @close="cancelTeamForm">
            <template #title>
                Create Team
            </template>

            <form @submit.prevent="createTeam" class="flex flex-col gap-6">
                <div>
                    <InputLabel for="college_name">
                        College Name
                    </InputLabel>
                    <TextInput
                        id="college_name"
                        v-model="teamForm.college_name"
                        type="text"
                        class="mt-1 block w-full"
                        :has-errors="teamForm.errors.college_name !== undefined"
                    />
                    <InputError :message="teamForm.errors. college_name" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="college_abbreviation">
                        College Abbreviation
                    </InputLabel>
                    <TextInput
                        id="college_abbreviation"
                        v-model="teamForm.college_abbreviation"
                        type="text"
                        class="mt-1 block w-full"
                        :has-errors="teamForm.errors.college_abbreviation !== undefined"
                    />
                    <InputError :message="teamForm.errors.college_abbreviation" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="mascot">
                        Mascot
                    </InputLabel>
                    <TextInput
                        id="mascot"
                        v-model="teamForm.mascot"
                        type="text"
                        class="mt-1 block w-full"
                        :has-errors="teamForm.errors.mascot !== undefined"
                    />
                    <InputError :message="teamForm.errors.mascot" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="location">
                        Location
                    </InputLabel>
                    <TextInput
                        id="location"
                        v-model="teamForm.location"
                        type="text"
                        class="mt-1 block w-full"
                        :has-errors="teamForm.errors.location !== undefined"
                    />
                    <InputError :message="teamForm.errors.location" class="mt-2" />
                </div>

                <div class="flex gap-4">
                    <PrimaryButton :disabled="teamForm.processing">
                        Create
                    </PrimaryButton>
                    <SecondaryButton type="button" @click.prevent="cancelTeamForm">
                        Cancel
                    </SecondaryButton>
                </div>
            </form>
        </Slideout>
        <Slideout :open="conferenceId !== null" @close="cancelDivisionForm">
            <template #title>
                Create Division
            </template>

            <form @submit.prevent="createDivision" class="flex flex-col gap-6">
                <div>
                    <InputLabel for="name">
                        Name
                    </InputLabel>
                    <TextInput
                        id="name"
                        v-model="divisionForm.name"
                        type="text"
                        class="mt-1 block w-full"
                        :has-errors="divisionForm.errors.name !== undefined"
                    />
                    <InputError :message="divisionForm.errors.name" class="mt-2" />
                </div>

                <div class="flex gap-4">
                    <PrimaryButton :disabled="divisionForm.processing">
                        Create
                    </PrimaryButton>
                    <SecondaryButton type="button" @click.prevent="cancelDivisionForm">
                        Cancel
                    </SecondaryButton>
                </div>
            </form>
        </Slideout>
        <Slideout :open="showConferenceForm" @close="cancelConferenceForm">
            <template #title>
                Create Conference
            </template>

            <form @submit.prevent="createConference" class="flex flex-col gap-6">
                <div>
                    <InputLabel for="name">
                        Name
                    </InputLabel>
                    <TextInput
                        id="name"
                        v-model="conferenceForm.name"
                        type="text"
                        class="mt-1 block w-full"
                        :has-errors="conferenceForm.errors.name !== undefined"
                    />
                    <InputError :message="conferenceForm.errors.name" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="abbreviation">
                        Abbreviation
                    </InputLabel>
                    <TextInput
                        id="name"
                        v-model="conferenceForm.abbreviation"
                        type="text"
                        class="mt-1 block w-full"
                        :has-errors="conferenceForm.errors.abbreviation !== undefined"
                    />
                    <InputError :message="conferenceForm.errors.abbreviation" class="mt-2" />
                </div>
                <div class="flex gap-4">
                    <PrimaryButton :disabled="conferenceForm.processing">
                        Create
                    </PrimaryButton>
                    <SecondaryButton type="button"
                                     @click.prevent="cancelConferenceForm">
                        Cancel
                    </SecondaryButton>
                </div>
            </form>
        </Slideout>
    </AppLayout>
</template>
