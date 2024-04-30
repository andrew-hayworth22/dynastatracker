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
import Card from "@/Components/Card.vue";
import {toNumber} from "@vue/shared";

const props = defineProps({
    season: {
        type: Object,
        required: true,
    },
    teams: {
        type: Array,
        required: true,
    },
});

const opposingTeamName = ref(null);
const form = useForm({
    'opp_team_id': null,
    'location': null,
    'type': null,
    'week': null,
    'coverage': null,
    'date': null,

    'our_score_q1': 0,
    'our_score_q2': 0,
    'our_score_q3': 0,
    'our_score_q4': 0,
    'our_score_ot': 0,
    'our_first_downs': null,
    'our_third_down_att': null,
    'our_third_down_conv': null,
    'our_fourth_down_att': null,
    'our_fourth_down_conv': null,
    'our_two_point_att': null,
    'our_two_point_conv': null,
    'our_red_zone_att': null,
    'our_red_zone_fgs': null,
    'our_red_zone_tds': null,
    'our_fumbles_lost': null,
    'our_penalties': null,
    'our_penalty_yards': null,
    'our_top_min': null,
    'our_top_sec': null,

    'opp_score_q1': 0,
    'opp_score_q2': 0,
    'opp_score_q3': 0,
    'opp_score_q4': 0,
    'opp_score_ot': 0,
    'opp_first_downs': null,
    'opp_rush_att': null,
    'opp_rush_yards': null,
    'opp_rush_tds': null,
    'opp_pass_comp': null,
    'opp_pass_att': null,
    'opp_pass_yds': null,
    'opp_pass_tds': null,
    'opp_third_down_att': null,
    'opp_third_down_conv': null,
    'opp_fourth_down_att': null,
    'opp_fourth_down_conv': null,
    'opp_two_point_att': null,
    'opp_two_point_conv': null,
    'opp_red_zone_att': null,
    'opp_red_zone_fgs': null,
    'opp_red_zone_tds': null,
    'opp_fumbles_lost': null,
    'opp_ints': null,
    'opp_punts': null,
    'opp_punt_avg': null,
    'opp_penalties': null,
    'opp_penalty_yds': null,
    'opp_top_min': null,
    'opp_top_sec': null,
});
const createGame = () => {
    // form.post(route('games.store', {season: props.season.id}));
};
</script>

<template>
    <AppLayout :title="`${season.dynasty.name} | Create Game`">
        <DynastyHeader :dynasty="season.dynasty" />

        <form @submit.prevent="createGame" class="flex flex-col gap-4">
            <Card>
                <template #title>
                    Game Information
                </template>

                <div class="grid sm:grid-cols-2 gap-x-4 gap-y-6">
                    <div>
                        <InputLabel for="opp_team">
                            Opposing Team
                        </InputLabel>
                        <InputSelect
                            id="opp_team"
                            v-model="form.opp_team_id"
                            class="mt-1 block w-full"
                        >
                            <option :value="null" disabled>
                                Select a team...
                            </option>
                            <option v-for="team in teams" :key="team.id" :value="team.id">
                                {{ team.college_abbreviation }}
                            </option>
                        </InputSelect>
                        <InputError :message="form.errors.opp_team_id" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="location">
                            Location
                        </InputLabel>
                        <InputSelect
                            id="location"
                            v-model="form.location"
                            class="mt-1 block w-full"
                        >
                            <option :value="null" disabled>
                                Select a location...
                            </option>
                            <option value="Home"> Home </option>
                            <option value="Away"> Away </option>
                            <option value="Neutral"> Neutral </option>
                        </InputSelect>
                        <InputError :message="form.errors.location" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="type">
                            Type
                        </InputLabel>
                        <InputSelect
                            id="type"
                            v-model="form.type"
                            class="mt-1 block w-full"
                        >
                            <option :value="null" disabled>
                                Select a type...
                            </option>
                            <option value="Regular Season"> Regular Season </option>
                            <option value="Conference Championship"> Conference Championship </option>
                            <option value="Bowl Game"> Bowl Game </option>
                            <option value="National Octafinals"> National Octafinals </option>
                            <option value="National Quarterfinals"> National Quarterfinals </option>
                            <option value="National Semifinals"> National Semifinals </option>
                            <option value="National Championship"> National Championship </option>
                        </InputSelect>
                        <InputError :message="form.errors.type" class="mt-2" />
                    </div>

                    <div v-if="form.type === 'Regular Season'">
                        <InputLabel for="week">
                            Week
                        </InputLabel>
                        <TextInput
                            id="week"
                            v-model="form.week"
                            type="number"
                            class="mt-1 block w-full"
                            min="1"
                            max="12"
                            :has-errors="form.errors.week !== undefined"
                        />
                        <InputError :message="form.errors.week" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="coverage">
                            Coverage
                        </InputLabel>
                        <InputSelect
                            id="coverage"
                            v-model="form.coverage"
                            class="mt-1 block w-full"
                        >
                            <option :value="null" disabled>
                                Select a coverage...
                            </option>
                            <option value="None"> None </option>
                            <option value="Regional"> Regional </option>
                            <option value="National"> National </option>
                        </InputSelect>
                        <InputError :message="form.errors.coverage" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="date">
                            Date
                        </InputLabel>
                        <TextInput
                            id="date"
                            v-model="form.date"
                            type="datetime-local"
                            class="mt-1 block w-full"
                            :has-errors="form.errors.date !== undefined"
                        />
                        <InputError :message="form.errors.date" class="mt-2" />
                    </div>
                </div>

            </Card>

            <Card>
                <template #title>
                    Box Score
                </template>

                <div class="grid grid-cols-7 gap-1 text-center">
                    <div></div>
                    <div class="pb-1 font-bold">1</div>
                    <div class="pb-1 font-bold">2</div>
                    <div class="pb-1 font-bold">3</div>
                    <div class="pb-1 font-bold">4</div>
                    <div class="pb-1 font-bold">OT</div>
                    <div class="pb-1 font-bold">F</div>

                    <div class="flex items-center text-left"> {{ season.team.college_abbreviation }} </div>
                    <div>
                        <TextInput
                            v-model="form.our_score_q1"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <TextInput
                            v-model="form.our_score_q2"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <TextInput
                            v-model="form.our_score_q3"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <TextInput
                            v-model="form.our_score_q4"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <TextInput
                            v-model="form.our_score_ot"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div class="font-bold flex items-center justify-center">
                        {{ toNumber(form.our_score_q1) + toNumber(form.our_score_q2) + toNumber(form.our_score_q3) + toNumber(form.our_score_q4) + toNumber(form.our_score_ot) }}
                    </div>

                    <div class="flex items-center text-left">
                        {{ opposingTeamName ?? 'Opposing Team' }}
                    </div>
                    <div>
                        <TextInput
                            v-model="form.opp_score_q1"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <TextInput
                            v-model="form.opp_score_q2"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <TextInput
                            v-model="form.opp_score_q3"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <TextInput
                            v-model="form.opp_score_q4"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <TextInput
                            v-model="form.opp_score_ot"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div class="font-bold flex items-center justify-center">
                        {{ toNumber(form.opp_score_q1) + toNumber(form.opp_score_q2) + toNumber(form.opp_score_q3) + toNumber(form.opp_score_q4) + toNumber(form.opp_score_ot) }}
                    </div>
                </div>
            </Card>

            <div class="grid xl:grid-cols-2 gap-4">
                <Card>
                    <template #title>
                        Our Team
                    </template>
                </Card>
                <Card>
                    <template #title>
                        Opposing Team
                    </template>
                </Card>
            </div>
        </form>
    </AppLayout>
</template>
