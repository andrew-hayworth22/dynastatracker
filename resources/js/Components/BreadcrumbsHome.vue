<script setup>
import {HomeIcon} from "@heroicons/vue/20/solid/index.js";
import {Link} from "@inertiajs/vue3";

defineProps({
    current: {
        type: Boolean,
    },
    route: {
        type: String,
        required: true,
    },
    name: {
        type: String,
        required: false,
        default: 'Home',
    },
});
</script>

<template>
    <li class="flex">
        <div class="flex items-center">
            <Link :href="route" class="text-gray-400 hover:text-gray-500" :aria-current="current ? 'page' : undefined">
                <HomeIcon class="h-5 w-5 flex-shrink-0" aria-hidden="true" />
                <span class="sr-only">{{ name }}</span>
            </Link>
        </div>
    </li>
</template>
