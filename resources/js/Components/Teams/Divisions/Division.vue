<script setup>
import TeamsList from "@/Components/Teams/Teams/TeamsList.vue";
import CreateTeam from "@/Components/Teams/Teams/CreateTeam.vue";

defineProps({
    'division': {
        type: Object
    },
    'conferenceAbbreviation': {
        type: String
    }
})
</script>

<template>
    <div class="flex justify-between mb-1">
        <h3 class="font-semibold">
            {{ conferenceAbbreviation + ((conferenceAbbreviation === division.name) ? '' : ' ' + division.name) }}
        </h3>
        <CreateTeam :divisionId="division.id"/>
    </div>

    <TeamsList class="mb-4" :teams="division.teams" :divisionId="division.id"/>
</template>

<style scoped>

</style>
