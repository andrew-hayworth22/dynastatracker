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
                    General Information
                </template>

                <div class="grid grid-cols-7 gap-1 text-center">
                    <div></div>
                    <div>1</div>
                    <div>2</div>
                    <div>3</div>
                    <div>4</div>
                    <div>OT</div>
                    <div>F</div>

                    <div class="text-left"> Our Team </div>
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
                    <div class="bold">
                        {{ toNumber(form.our_score_q1) + toNumber(form.our_score_q2) + toNumber(form.our_score_q3) + toNumber(form.our_score_q4) + toNumber(form.our_score_ot) }}
                    </div>

                    <div class="text-left">
                        Opposing Team
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
                    <div class="bold">
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
