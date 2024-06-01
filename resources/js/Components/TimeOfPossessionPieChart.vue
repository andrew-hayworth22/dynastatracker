<script setup>
import { teamColors} from "@/Composables/colors.js";

const props = defineProps({
    game: {
        type: Object,
        required: true,
    },
});

const colors = teamColors();

const options = {
    chart: {
        toolbar: {
            show: false
        },
        zoom: {
            enabled: false
        }
    },
    labels: [props.game.season.team.college_name, props.game.opp_team.college_name],
    colors: [colors.us, colors.opp]
}

const series = [props.game.our_top_percentage, props.game.opp_top_percentage]
</script>

<template>
    <apexchart :series="series" type="pie" :options="options"/>
</template>
