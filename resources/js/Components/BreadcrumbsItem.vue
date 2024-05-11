<script setup>
    import {Link} from "@inertiajs/vue3";

    defineProps({
        current: {
            type: Boolean,
        },
        route: {
            type: String,
            required: true,
        }
    });
</script>

<template>
    <li class="flex">
        <div class="flex items-center">
            <svg class="h-full w-6 flex-shrink-0 text-gray-200" viewBox="0 0 24 44" preserveAspectRatio="none" fill="currentColor" aria-hidden="true">
                <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
            </svg>
            <Link :href="route" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" :aria-current="current ? 'page' : undefined">
                <slot/>
            </Link>
        </div>
    </li>
</template>
