<script setup>
import Button from "@/Components/Buttons/Button.vue";
import UpdateTeam from "@/Components/Teams/Teams/UpdateTeam.vue";

defineProps({
    'team': {
        type: Object
    }
})
</script>

<template>
    <tr class="odd:bg-gray-100 even:bg-gray-50">
        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-3">{{ team.abbrev_college_name }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ team.mascot_name }}</td>
        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ team.location }}</td>
        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-3">
            <UpdateTeam :team="team"/>
        </td>
    </tr>
</template>
