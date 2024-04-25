<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    size: {
        type: String,
        default: 'md',
    },
});
</script>

<template>
    <button :type="type" :class="{
        'rounded px-2 py-1 text-xs': size === 'xs',
        'rounded-md px-2.5 py-1.5 text-sm': size === 'md',
        'bg-indigo-600 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600': true
    }">
        <slot />
    </button>
</template>
