<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";
import EmptyState from "@/Components/EmptyState.vue";
import ListItem from "@/Components/ListItem.vue";
import {Link, useForm} from "@inertiajs/vue3";
import {computed, onMounted, ref} from "vue";
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

const form = useForm({
    'opp_team_id': null,
    'location': null,
    'type': null,
    'week': 0,
    'coverage': null,
    'date': null,

    'our_score_q1': 0,
    'our_score_q2': 0,
    'our_score_q3': 0,
    'our_score_q4': 0,
    'our_score_ot': 0,
    'our_first_downs': 0,
    'our_rush_att': 0,
    'our_rush_yds': 0,
    'our_rush_tds': 0,
    'our_pass_comp': 0,
    'our_pass_att': 0,
    'our_pass_yds': 0,
    'our_pass_tds': 0,
    'our_third_down_att': 0,
    'our_third_down_conv': 0,
    'our_fourth_down_att': 0,
    'our_fourth_down_conv': 0,
    'our_two_point_att': 0,
    'our_two_point_conv': 0,
    'our_red_zone_att': 0,
    'our_red_zone_fgs': 0,
    'our_red_zone_tds': 0,
    'our_fumbles_lost': 0,
    'our_ints': 0,
    'our_punt_return_yds': 0,
    'our_kick_return_yds': 0,
    'our_punts': 0,
    'our_punt_avg': 0,
    'our_penalties': 0,
    'our_penalty_yds': 0,
    'our_top_min': 0,
    'our_top_sec': 0,

    'opp_score_q1': 0,
    'opp_score_q2': 0,
    'opp_score_q3': 0,
    'opp_score_q4': 0,
    'opp_score_ot': 0,
    'opp_first_downs': 0,
    'opp_rush_att': 0,
    'opp_rush_yds': 0,
    'opp_rush_tds': 0,
    'opp_pass_comp': 0,
    'opp_pass_att': 0,
    'opp_pass_yds': 0,
    'opp_pass_tds': 0,
    'opp_third_down_att': 0,
    'opp_third_down_conv': 0,
    'opp_fourth_down_att': 0,
    'opp_fourth_down_conv': 0,
    'opp_two_point_att': 0,
    'opp_two_point_conv': 0,
    'opp_red_zone_att': 0,
    'opp_red_zone_fgs': 0,
    'opp_red_zone_tds': 0,
    'opp_fumbles_lost': 0,
    'opp_ints': 0,
    'opp_punt_return_yds': 0,
    'opp_kick_return_yds': 0,
    'opp_punts': 0,
    'opp_punt_avg': 0,
    'opp_penalties': 0,
    'opp_penalty_yds': 0,
    'opp_top_min': 0,
    'opp_top_sec': 0,
});
const createGame = () => {
    form.post(route('seasons.games.store', {season: props.season.id}));
};

const opposingTeamName = ref('Opposing Team');

const updateOpposingTeamName = () => {
    const dropdown = document.getElementById('opp_team');

    if(dropdown === null || dropdown.selectedOptions.length === 0) {
        opposingTeamName.value = 'Opposing Team';
        return;
    }

    opposingTeamName.value = dropdown.selectedOptions[0].innerText;
};
</script>

<template>
    <AppLayout :title="`${season.dynasty.name} | Create Game`" :selected_dynasty_id="season.dynasty.id">
        <DynastyHeader :dynasty="season.dynasty" />

        <form @submit.prevent="createGame" class="flex flex-col gap-4">
            <Card>
                <template #title>
                    Game Information
                </template>

                <div class="sm:flex gap-4">
                    <div class="flex-1 flex flex-col gap-6">
                        <div>
                            <InputLabel for="opp_team">
                                Opposing Team
                            </InputLabel>
                            <InputSelect
                                id="opp_team"
                                v-model="form.opp_team_id"
                                class="mt-1 block w-full"
                                @change="updateOpposingTeamName"
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
                    </div>

                    <div class="flex-1 flex flex-col gap-6">
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
                        <InputLabel for="our_score_q1" class="sr-only">
                            Our Score Q1
                        </InputLabel>
                        <TextInput
                            v-model="form.our_score_q1"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <InputLabel for="our_score_q2" class="sr-only">
                            Our Score Q2
                        </InputLabel>
                        <TextInput
                            v-model="form.our_score_q2"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <InputLabel for="our_score_q3" class="sr-only">
                            Our Score Q3
                        </InputLabel>
                        <TextInput
                            v-model="form.our_score_q3"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <InputLabel for="our_score_q4" class="sr-only">
                            Our Score Q4
                        </InputLabel>
                        <TextInput
                            v-model="form.our_score_q4"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <InputLabel for="our_score_ot" class="sr-only">
                            Our Score OT
                        </InputLabel>
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
                        {{ opposingTeamName }}
                    </div>
                    <div>
                        <InputLabel for="opp_score_q1" class="sr-only">
                            Opponent Score Q1
                        </InputLabel>
                        <TextInput
                            v-model="form.opp_score_q1"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <InputLabel for="opp_score_q2" class="sr-only">
                            Opponent Score Q2
                        </InputLabel>
                        <TextInput
                            v-model="form.opp_score_q2"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <InputLabel for="opp_score_q3" class="sr-only">
                            Opponent Score Q3
                        </InputLabel>
                        <TextInput
                            v-model="form.opp_score_q3"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <InputLabel for="opp_score_q4" class="sr-only">
                            Opponent Score Q4
                        </InputLabel>
                        <TextInput
                            v-model="form.opp_score_q4"
                            type="number"
                            min="0"
                            class="block w-full"
                        />
                    </div>
                    <div>
                        <InputLabel for="opp_score_ot" class="sr-only">
                            Opponent Score OT
                        </InputLabel>
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
                        {{ season.team.college_abbreviation }} Team Stats
                    </template>

                    <div class="flex flex-col gap-6">
                        <div>
                            <InputLabel for="our_first_downs">
                                First Downs
                            </InputLabel>
                            <TextInput
                                id="our_first_downs"
                                v-model="form.our_first_downs"
                                type="number"
                                class="mt-1 block w-full"
                                min="0"
                                :has-errors="form.errors.our_first_downs !== undefined"
                            />
                            <InputError :message="form.errors.our_first_downs" class="mt-2" />
                        </div>

                        <div class="flex flex-col sm:flex-row gap-6 sm:gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_rush_att">
                                    Rush Attempts
                                </InputLabel>
                                <TextInput
                                    id="our_rush_att"
                                    v-model="form.our_rush_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_rush_att !== undefined"
                                />
                                <InputError :message="form.errors.our_rush_att" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_rush_yds">
                                    Rush Yards
                                </InputLabel>
                                <TextInput
                                    id="our_rush_yds"
                                    v-model="form.our_rush_yds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_rush_yds !== undefined"
                                />
                                <InputError :message="form.errors.our_rush_yds" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_rush_tds">
                                    Rushing Touchdowns
                                </InputLabel>
                                <TextInput
                                    id="our_rush_tds"
                                    v-model="form.our_rush_tds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_rush_tds !== undefined"
                                />
                                <InputError :message="form.errors.our_rush_tds" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-6 sm:gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_pass_comp">
                                    Pass Completions
                                </InputLabel>
                                <TextInput
                                    id="our_pass_comp"
                                    v-model="form.our_pass_comp"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_pass_comp !== undefined"
                                />
                                <InputError :message="form.errors.our_pass_comp" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_pass_att">
                                    Pass Attempts
                                </InputLabel>
                                <TextInput
                                    id="our_pass_att"
                                    v-model="form.our_pass_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_pass_att !== undefined"
                                />
                                <InputError :message="form.errors.our_pass_att" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_pass_yds">
                                    Passing Yards
                                </InputLabel>
                                <TextInput
                                    id="our_pass_yds"
                                    v-model="form.our_pass_yds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_pass_yds !== undefined"
                                />
                                <InputError :message="form.errors.our_pass_yds" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_pass_tds">
                                    Passing Touchdowns
                                </InputLabel>
                                <TextInput
                                    id="our_pass_tds"
                                    v-model="form.our_pass_tds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_pass_tds !== undefined"
                                />
                                <InputError :message="form.errors.our_pass_tds" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_third_down_conv">
                                    Third Down Conversions
                                </InputLabel>
                                <TextInput
                                    id="our_third_down_conv"
                                    v-model="form.our_third_down_conv"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_third_down_conv !== undefined"
                                />
                                <InputError :message="form.errors.our_third_down_conv" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_third_down_att">
                                    Third Down Attempts
                                </InputLabel>
                                <TextInput
                                    id="our_third_down_att"
                                    v-model="form.our_third_down_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_third_down_att !== undefined"
                                />
                                <InputError :message="form.errors.our_third_down_att" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_fourth_down_conv">
                                    Fourth Down Conversions
                                </InputLabel>
                                <TextInput
                                    id="our_fourth_down_conv"
                                    v-model="form.our_fourth_down_conv"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_fourth_down_conv !== undefined"
                                />
                                <InputError :message="form.errors.our_fourth_down_conv" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_fourth_down_att">
                                    Fourth Down Attempts
                                </InputLabel>
                                <TextInput
                                    id="our_fourth_down_att"
                                    v-model="form.our_fourth_down_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_fourth_down_att !== undefined"
                                />
                                <InputError :message="form.errors.our_fourth_down_att" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_two_point_conv">
                                    Two-Point Conversions
                                </InputLabel>
                                <TextInput
                                    id="our_two_point_conv"
                                    v-model="form.our_two_point_conv"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_two_point_conv !== undefined"
                                />
                                <InputError :message="form.errors.our_two_point_conv" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_two_point_att">
                                    Two-Point Attempts
                                </InputLabel>
                                <TextInput
                                    id="our_two_point_att"
                                    v-model="form.our_two_point_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_two_point_att !== undefined"
                                />
                                <InputError :message="form.errors.our_two_point_att" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-6 sm:gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_red_zone_fgs">
                                    Red Zone Field Goals
                                </InputLabel>
                                <TextInput
                                    id="our_red_zone_fgs"
                                    v-model="form.our_red_zone_fgs"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_red_zone_fgs !== undefined"
                                />
                                <InputError :message="form.errors.our_red_zone_fgs" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_red_zone_tds">
                                    Red Zone Touchdowns
                                </InputLabel>
                                <TextInput
                                    id="our_red_zone_tds"
                                    v-model="form.our_red_zone_tds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_red_zone_tds !== undefined"
                                />
                                <InputError :message="form.errors.our_red_zone_tds" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_red_zone_att">
                                    Red Zone Attempts
                                </InputLabel>
                                <TextInput
                                    id="our_red_zone_att"
                                    v-model="form.our_red_zone_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_red_zone_att !== undefined"
                                />
                                <InputError :message="form.errors.our_red_zone_att" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_fumbles_lost">
                                    Fumbles Lost
                                </InputLabel>
                                <TextInput
                                    id="our_fumbles_lost"
                                    v-model="form.our_fumbles_lost"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_fumbles_lost !== undefined"
                                />
                                <InputError :message="form.errors.our_fumbles_lost" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_ints">
                                    Interceptions
                                </InputLabel>
                                <TextInput
                                    id="our_ints"
                                    v-model="form.our_ints"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_ints !== undefined"
                                />
                                <InputError :message="form.errors.our_ints" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_punt_return_yds">
                                    Punt Return Yards
                                </InputLabel>
                                <TextInput
                                    id="our_punt_return_yds"
                                    v-model="form.our_punt_return_yds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_punt_return_yds !== undefined"
                                />
                                <InputError :message="form.errors.our_punt_return_yds" class="mt-2" />
                            </div>
                            <div class="flex-1">
                                <InputLabel for="our_kick_return_yds">
                                    Kick Return Yards
                                </InputLabel>
                                <TextInput
                                    id="our_kick_return_yds"
                                    v-model="form.our_kick_return_yds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_kick_return_yds !== undefined"
                                />
                                <InputError :message="form.errors.our_kick_return_yds" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_punts">
                                    Punts
                                </InputLabel>
                                <TextInput
                                    id="our_punts"
                                    v-model="form.our_punts"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_punts !== undefined"
                                />
                                <InputError :message="form.errors.our_punts" class="mt-2" />
                            </div>
                            <div class="flex-1">
                                <InputLabel for="our_punt_avg">
                                    Average Punt Yards
                                </InputLabel>
                                <TextInput
                                    id="our_punt_avg"
                                    v-model="form.our_punt_avg"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_punt_avg !== undefined"
                                />
                                <InputError :message="form.errors.our_punt_avg" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_penalties">
                                    Penalties
                                </InputLabel>
                                <TextInput
                                    id="our_penalties"
                                    v-model="form.our_penalties"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_penalties !== undefined"
                                />
                                <InputError :message="form.errors.our_penalties" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_penalty_yds">
                                    Penalty Yards
                                </InputLabel>
                                <TextInput
                                    id="our_penalty_yds"
                                    v-model="form.our_penalty_yds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_penalty_yds !== undefined"
                                />
                                <InputError :message="form.errors.our_penalty_yds" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="our_top_min">
                                    Time of Possession (Minutes)
                                </InputLabel>
                                <TextInput
                                    id="our_top_min"
                                    v-model="form.our_top_min"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.our_top_min !== undefined"
                                />
                                <InputError :message="form.errors.our_top_min" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="our_top_sec">
                                    Time of Possession (Seconds)
                                </InputLabel>
                                <TextInput
                                    id="our_top_sec"
                                    v-model="form.our_top_sec"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    max="59"
                                    :has-errors="form.errors.our_top_sec !== undefined"
                                />
                                <InputError :message="form.errors.our_top_sec" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </Card>
                <Card>
                    <template #title>
                        {{ opposingTeamName }} Team Stats
                    </template>

                    <div class="flex flex-col gap-6">
                        <div>
                            <InputLabel for="opp_first_downs">
                                First Downs
                            </InputLabel>
                            <TextInput
                                id="opp_first_downs"
                                v-model="form.opp_first_downs"
                                type="number"
                                class="mt-1 block w-full"
                                min="0"
                                :has-errors="form.errors.opp_first_downs !== undefined"
                            />
                            <InputError :message="form.errors.opp_first_downs" class="mt-2" />
                        </div>

                        <div class="flex flex-col sm:flex-row gap-6 sm:gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_rush_att">
                                    Rush Attempts
                                </InputLabel>
                                <TextInput
                                    id="opp_rush_att"
                                    v-model="form.opp_rush_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_rush_att !== undefined"
                                />
                                <InputError :message="form.errors.opp_rush_att" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_rush_yds">
                                    Rush Yards
                                </InputLabel>
                                <TextInput
                                    id="opp_rush_yds"
                                    v-model="form.opp_rush_yds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_rush_yds !== undefined"
                                />
                                <InputError :message="form.errors.opp_rush_yds" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_rush_tds">
                                    Rushing Touchdowns
                                </InputLabel>
                                <TextInput
                                    id="opp_rush_tds"
                                    v-model="form.opp_rush_tds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_rush_tds !== undefined"
                                />
                                <InputError :message="form.errors.opp_rush_tds" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-6 sm:gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_pass_comp">
                                    Pass Completions
                                </InputLabel>
                                <TextInput
                                    id="opp_pass_comp"
                                    v-model="form.opp_pass_comp"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_pass_comp !== undefined"
                                />
                                <InputError :message="form.errors.opp_pass_comp" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_pass_att">
                                    Pass Attempts
                                </InputLabel>
                                <TextInput
                                    id="opp_pass_att"
                                    v-model="form.opp_pass_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_pass_att !== undefined"
                                />
                                <InputError :message="form.errors.opp_pass_att" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_pass_yds">
                                    Passing Yards
                                </InputLabel>
                                <TextInput
                                    id="opp_pass_yds"
                                    v-model="form.opp_pass_yds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_pass_yds !== undefined"
                                />
                                <InputError :message="form.errors.opp_pass_yds" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_pass_tds">
                                    Passing Touchdowns
                                </InputLabel>
                                <TextInput
                                    id="opp_pass_tds"
                                    v-model="form.opp_pass_tds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_pass_tds !== undefined"
                                />
                                <InputError :message="form.errors.opp_pass_tds" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_third_down_conv">
                                    Third Down Conversions
                                </InputLabel>
                                <TextInput
                                    id="opp_third_down_conv"
                                    v-model="form.opp_third_down_conv"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_third_down_conv !== undefined"
                                />
                                <InputError :message="form.errors.opp_third_down_conv" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_third_down_att">
                                    Third Down Attempts
                                </InputLabel>
                                <TextInput
                                    id="opp_third_down_att"
                                    v-model="form.opp_third_down_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_third_down_att !== undefined"
                                />
                                <InputError :message="form.errors.opp_third_down_att" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_fourth_down_conv">
                                    Fourth Down Conversions
                                </InputLabel>
                                <TextInput
                                    id="opp_fourth_down_conv"
                                    v-model="form.opp_fourth_down_conv"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_fourth_down_conv !== undefined"
                                />
                                <InputError :message="form.errors.opp_fourth_down_conv" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_fourth_down_att">
                                    Fourth Down Attempts
                                </InputLabel>
                                <TextInput
                                    id="opp_fourth_down_att"
                                    v-model="form.opp_fourth_down_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_fourth_down_att !== undefined"
                                />
                                <InputError :message="form.errors.opp_fourth_down_att" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_two_point_conv">
                                    Two-Point Conversions
                                </InputLabel>
                                <TextInput
                                    id="opp_two_point_conv"
                                    v-model="form.opp_two_point_conv"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_two_point_conv !== undefined"
                                />
                                <InputError :message="form.errors.opp_two_point_conv" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_two_point_att">
                                    Two-Point Attempts
                                </InputLabel>
                                <TextInput
                                    id="opp_two_point_att"
                                    v-model="form.opp_two_point_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_two_point_att !== undefined"
                                />
                                <InputError :message="form.errors.opp_two_point_att" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-6 sm:gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_red_zone_fgs">
                                    Red Zone Field Goals
                                </InputLabel>
                                <TextInput
                                    id="opp_red_zone_fgs"
                                    v-model="form.opp_red_zone_fgs"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_red_zone_fgs !== undefined"
                                />
                                <InputError :message="form.errors.opp_red_zone_fgs" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_red_zone_tds">
                                    Red Zone Touchdowns
                                </InputLabel>
                                <TextInput
                                    id="opp_red_zone_tds"
                                    v-model="form.opp_red_zone_tds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_red_zone_tds !== undefined"
                                />
                                <InputError :message="form.errors.opp_red_zone_tds" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_red_zone_att">
                                    Red Zone Attempts
                                </InputLabel>
                                <TextInput
                                    id="opp_red_zone_att"
                                    v-model="form.opp_red_zone_att"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_red_zone_att !== undefined"
                                />
                                <InputError :message="form.errors.opp_red_zone_att" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_fumbles_lost">
                                    Fumbles Lost
                                </InputLabel>
                                <TextInput
                                    id="opp_fumbles_lost"
                                    v-model="form.opp_fumbles_lost"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_fumbles_lost !== undefined"
                                />
                                <InputError :message="form.errors.opp_fumbles_lost" class="mt-2" />
                            </div>
                            <div class="flex-1">
                                <InputLabel for="opp_ints">
                                    Interceptions
                                </InputLabel>
                                <TextInput
                                    id="opp_ints"
                                    v-model="form.opp_ints"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_ints !== undefined"
                                />
                                <InputError :message="form.errors.opp_ints" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_punt_return_yds">
                                    Punt Return Yards
                                </InputLabel>
                                <TextInput
                                    id="opp_punt_return_yds"
                                    v-model="form.opp_punt_return_yds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_punt_return_yds !== undefined"
                                />
                                <InputError :message="form.errors.opp_punt_return_yds" class="mt-2" />
                            </div>
                            <div class="flex-1">
                                <InputLabel for="opp_kick_return_yds">
                                    Kick Return Yards
                                </InputLabel>
                                <TextInput
                                    id="opp_kick_return_yds"
                                    v-model="form.opp_kick_return_yds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_kick_return_yds !== undefined"
                                />
                                <InputError :message="form.errors.opp_kick_return_yds" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_punts">
                                    Punts
                                </InputLabel>
                                <TextInput
                                    id="opp_punts"
                                    v-model="form.opp_punts"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_punts !== undefined"
                                />
                                <InputError :message="form.errors.opp_punts" class="mt-2" />
                            </div>
                            <div class="flex-1">
                                <InputLabel for="opp_punt_avg">
                                    Average Punt Yards
                                </InputLabel>
                                <TextInput
                                    id="opp_punt_avg"
                                    v-model="form.opp_punt_avg"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_punt_avg !== undefined"
                                />
                                <InputError :message="form.errors.opp_punt_avg" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_penalties">
                                    Penalties
                                </InputLabel>
                                <TextInput
                                    id="opp_penalties"
                                    v-model="form.opp_penalties"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_penalties !== undefined"
                                />
                                <InputError :message="form.errors.opp_penalties" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_penalty_yds">
                                    Penalty Yards
                                </InputLabel>
                                <TextInput
                                    id="opp_penalty_yds"
                                    v-model="form.opp_penalty_yds"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_penalty_yds !== undefined"
                                />
                                <InputError :message="form.errors.opp_penalty_yds" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <InputLabel for="opp_top_min">
                                    Time of Possession (Minutes)
                                </InputLabel>
                                <TextInput
                                    id="opp_top_min"
                                    v-model="form.opp_top_min"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    :has-errors="form.errors.opp_top_min !== undefined"
                                />
                                <InputError :message="form.errors.opp_top_min" class="mt-2" />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="opp_top_sec">
                                    Time of Possession (Seconds)
                                </InputLabel>
                                <TextInput
                                    id="opp_top_sec"
                                    v-model="form.opp_top_sec"
                                    type="number"
                                    class="mt-1 block w-full"
                                    min="0"
                                    max="59"
                                    :has-errors="form.errors.opp_top_sec !== undefined"
                                />
                                <InputError :message="form.errors.opp_top_sec" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </Card>
            </div>
            <Card>
                <PrimaryButton :disabled="form.processing">
                    Save
                </PrimaryButton>
            </Card>
        </form>
    </AppLayout>
</template>
