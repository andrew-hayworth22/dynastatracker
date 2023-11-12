<script setup>

import Button from "@/Components/Buttons/Button.vue";
import CreateTeam from "@/Components/Teams/Teams/CreateTeam.vue";
import Team from "@/Components/Teams/Teams/Team.vue";

defineProps({
    'divisionId': {
        type: Number
    },
    'teams': {
        type: Array
    }
})
</script>

<template>
    <div class="flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <tbody class="bg-white">
                        <Team v-for="team in teams" :team="team" :key="team.id"/>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
