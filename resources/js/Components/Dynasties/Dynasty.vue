<script setup>
import moment from "moment"
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    'dynasty': Object
})

</script>

<template>
    <li class="flex items-center justify-between gap-x-6 py-5">
        <div class="min-w-0">
            <div class="flex items-start gap-x-3">
                <Link :href="route('dynasty.show', {id: dynasty.id})">
                    <p class="text-sm font-semibold leading-6 text-gray-900">{{ dynasty.name }}</p>
                </Link>
                <p :class="{
                    'rounded-md whitespace-nowrap mt-0.5 px-1.5 py-0.5 text-xs font-medium ring-1 ring-inset': true,
                    'text-green-700 ring-green-700 bg-green-500 bg-opacity-10': dynasty.status === 'Active'
                }">
                    {{ dynasty.status }}
                </p>
            </div>
            <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                <p class="whitespace-nowrap">
                    Created <time :datetime="dynasty.created_at">{{ moment(dynasty.created_at).format("ddd. MMM. D, YYYY h:mm A") }}</time>
                </p>
                •
                <p class="truncate">Coach {{ dynasty.coach_name }}</p>
            </div>
        </div>
    </li>
</template>
