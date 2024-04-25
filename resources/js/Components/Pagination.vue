<script setup>
import { Link } from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    meta: {
        type: Object,
        required: true,
    },
    only: {
        type: Array,
        default: []
    },
    filter: {
        type: Object,
        default: {}
    }
});

const queryString = computed(() => {
    let result = '';

    for(const key in props.filter) {
        result += `&filter[${key}]=${props.filter[key]}`;
    }

    return result;
});

const previousUrl = computed(() => props.meta.links[0].url + queryString);
const nextUrl = computed(() => [...props.meta.links].reverse()[0].url + queryString);

</script>

<template>
    <div>
        <div class="flex rounded-b-md shadow-sm items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            <div class="flex flex-1 justify-between sm:hidden">
                <Link :href="previousUrl ? previousUrl : '#'"
                      class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                      :only="only">
                    Previous
                </Link>
                <Link :href="nextUrl ? nextUrl : '#'" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                      :only="only">
                    Next
                </Link>
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing

                        <span class="font-medium">{{ meta.from }}</span>
                        {{ ' ' }}
                        to
                        {{ ' ' }}
                        <span class="font-medium">{{ meta.to }}</span>
                        {{ ' ' }}
                        of
                        {{ ' ' }}
                        <span class="font-medium">{{ meta.total }}</span>
                        {{ ' ' }}
                        results
                    </p>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <Link v-for="link in meta.links" :key="link.label"
                              :href="link.url ? link.url + queryString : '#'"
                              :aria-current="link.active ? 'page' : null"
                              :class="{'relative inline-flex items-center px-4 py-2 text-sm font-semibold first-of-type:rounded-l-md last-of-type:rounded-r-md': true,
                                      'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600': link.active,
                                      'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0' : !link.active}"
                              :only="only">
                            {{ link.label }}
                        </Link>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>
