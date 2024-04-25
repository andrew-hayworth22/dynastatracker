<script setup>
defineProps({
    color: {
        type: String,
        default: 'gray',
    }
})
</script>

<template>
    <span :class="{'inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-600/20': true,
                   'bg-green-50 text-green-700 ring-green-600/20': color === 'green',
                   'bg-orange-50 text-orange-700 ring-orange-600/20': color === 'orange'}">
        <slot/>
    </span>
</template>
