<script setup>
import DynastyItem from "@/Components/Dynasties/Dynasty.vue"
import CreateDynasty from "@/Components/Dynasties/CreateDynasty.vue"
import EmptyState from "@/Components/EmptyState.vue";

const props = defineProps({
    'dynasties': {
        type: Array
    }
})
</script>

<template>
    <ul v-if="props.dynasties.length" role="list" class="divide-y divide-gray-200">
        <DynastyItem v-for="dynasty in props.dynasties" :dynasty="dynasty" :key="dynasty.id"/>
        <CreateDynasty/>
    </ul>
    <p v-else class="py-2">
        <EmptyState>
            <template #title> No dynasties </template>
            <template #body> Start by creating your first dynasty! </template>
            <template #buttons> <CreateDynasty/> </template>
        </EmptyState>
    </p>
</template>
