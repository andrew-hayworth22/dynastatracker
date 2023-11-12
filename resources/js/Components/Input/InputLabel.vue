<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="block text-sm font-medium leading-6 text-gray-900">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
