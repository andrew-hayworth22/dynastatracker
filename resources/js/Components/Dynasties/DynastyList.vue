<script setup>
import DynastyItem from "@/Components/Dynasties/Dynasty.vue"
import CreateDynasty from "@/Components/Dynasties/CreateDynasty.vue"

const props = defineProps({
    'dynasties': {
        type: Array
    }
})
</script>

<template>
    <p v-if="props.dynasties.length === 0" class="py-2">
        You do not have any dynasties!
    </p>
    <template v-else>
        <ul role="list" class="divide-y divide-gray-200">
            <DynastyItem v-for="dynasty in props.dynasties" :dynasty="dynasty" :key="dynasty.id"/>
        </ul>
    </template>
    <CreateDynasty/>
</template>
