<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    to: String,
    type: {
        type: String,
        default: 'primary'
    },
    size: {
        type: String,
        default: 'base'
    }
})
</script>

<template>
    <Link
        :href="to"
        :class="{
            'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600': type === 'primary',
            'bg-white text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50': type === 'secondary',
            'rounded-md px-3 py-2 text-sm font-semibold shadow-sm': size === 'base'
        }"
    >
        <slot/>
    </Link>
</template>
