<script setup>
import Division from "@/Components/Teams/Divisions/Division.vue";
import EmptyState from "@/Components/EmptyState.vue";
import CreateDivision from "@/Components/Teams/Divisions/CreateDivision.vue";

defineProps({
    'conferenceId': Number,
    'conferenceAbbreviation': String,
    'divisions': Array
})
</script>

<template>
    <div>
        <template v-if="divisions.length">
            <Division
                v-for="division in divisions"
                :key="division.id"
                :division="division"
                :conferenceAbbreviation="conferenceAbbreviation">
            </Division>
        </template>
        <template v-else>
            <EmptyState>
                <template #title>
                    No divisions...
                </template>
                <template #body>
                    Create a division to get started
                </template>
                <template #buttons>
                    <CreateDivision :conferenceId="conferenceId"/>
                </template>
            </EmptyState>
        </template>
    </div>
</template>
