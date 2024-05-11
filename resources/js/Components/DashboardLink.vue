<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {ChevronRightIcon} from "@heroicons/vue/24/solid/index.js";
</script>

<template>
    <Link class="flex justify-between bg-white px-4 py-3 sm:shadow sm:rounded-lg">
        <slot/>
        <ChevronRightIcon class="h-5 w-5 text-gray-400"/>
    </Link>
</template>
