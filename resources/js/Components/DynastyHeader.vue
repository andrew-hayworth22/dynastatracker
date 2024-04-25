<script setup>
import Tabs from "@/Components/Tabs.vue";

const props = defineProps({
    dynasty: Object
})

const tabs = [
    {
        name: 'Dashboard',
        url: route('dynasties.show', props.dynasty.id),
        current: route().current('dynasties.show', props.dynasty.id)
    },
    {
        name: 'Seasons',
        url: route('dynasties.seasons.index', props.dynasty.id),
        current: route().current('dynasties.seasons.index', props.dynasty.id)
    },
    {
        name: 'Players',
        url: route('dynasties.players.index', props.dynasty.id),
        current: route().current('dynasties.players.index', props.dynasty.id)
    },
    {
        name: 'Teams',
        url: route('dynasties.conferences.index', props.dynasty.id),
        current: route().current('dynasties.conferences.index', props.dynasty.id)
    }
]
</script>

<template>
    <div class="mb-6">
        <div class="flex justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">
                {{ dynasty.name }}
            </h1>
        </div>

        <Tabs :tabs="tabs"/>
    </div>
</template>

<style scoped>

</style>
