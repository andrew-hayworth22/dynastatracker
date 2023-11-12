<script setup>
import DivisionList from "@/Components/Teams/Divisions/DivisionList.vue";
import Button from "@/Components/Buttons/Button.vue";
import CreateDivision from "@/Components/Teams/Divisions/CreateDivision.vue";

defineProps({
    'conference': {
        type: Object
    }
})
</script>

<template>
    <div>
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold">
                {{ conference.name }}
            </h2>
            <CreateDivision :conferenceId="conference.id"/>
        </div>

        <hr class="my-2"/>
        <DivisionList :divisions="conference.divisions" :conferenceAbbreviation="conference.abbreviation"/>
    </div>
</template>

<style scoped>

</style>
