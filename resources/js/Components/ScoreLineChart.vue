<script setup>
import {teamColors} from "@/Composables/colors.js";

const props = defineProps({
    game: {
        type: Object,
        required: true,
    },
});

const colors = teamColors();

const options = {
    xaxis: {
        categories: ['Q1', 'Q2', 'Q3', 'Q4', 'OT']
    },
    chart: {
        toolbar: {
            show: false
        },
        zoom: {
            enabled: false
        }
    },
}

const series = [
    {
        name: props.game.season.team.college_name,
        data: [
            props.game.our_score_q1,
            props.game.our_score_q1 + props.game.our_score_q2,
            props.game.our_score_q1 + props.game.our_score_q2 + props.game.our_score_q3,
            props.game.our_score_q1 + props.game.our_score_q2 + props.game.our_score_q3 + props.game.our_score_q4,
            props.game.our_score_q1 + props.game.our_score_q2 + props.game.our_score_q3 + props.game.our_score_q4 + props.game.our_score_ot
        ],
        color: colors.us
    },
    {
        name: props.game.opp_team.college_name,
        data: [
            props.game.opp_score_q1,
            props.game.opp_score_q1 + props.game.opp_score_q2,
            props.game.opp_score_q1 + props.game.opp_score_q2 + props.game.opp_score_q3,
            props.game.opp_score_q1 + props.game.opp_score_q2 + props.game.opp_score_q3 + props.game.opp_score_q4,
            props.game.opp_score_q1 + props.game.opp_score_q2 + props.game.opp_score_q3 + props.game.opp_score_q4 + props.game.opp_score_ot
        ],
        color: colors.opp
    }
]
</script>

<template>
    <apexchart type="line" :series="series" :options="options"/>
</template>
