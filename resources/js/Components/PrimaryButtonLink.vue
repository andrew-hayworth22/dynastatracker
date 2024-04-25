<script setup>
import { Link} from "@inertiajs/vue3";
defineProps({
    size: {
        type: String,
        default: 'md',
    },
});
</script>

<template>
    <Link :class="{
        'rounded px-2 py-1 text-xs': size === 'xs',
        'rounded-md px-2.5 py-1.5 text-sm': size === 'md',
        'inline-block bg-indigo-600 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600': true
    }">
        <slot />
    </Link>
</template>
