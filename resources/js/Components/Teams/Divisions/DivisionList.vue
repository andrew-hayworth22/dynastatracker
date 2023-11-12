<script setup>
import Division from "@/Components/Teams/Divisions/Division.vue";

defineProps({
    'conferenceAbbreviation': String,
    'divisions': Array
})
</script>

<template>
    <div>
        <Division
            v-for="division in divisions"
            :key="division.id"
            :division="division"
            :conferenceAbbreviation="conferenceAbbreviation">
        </Division>
    </div>
</template>
