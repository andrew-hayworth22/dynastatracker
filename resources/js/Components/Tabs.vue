<script setup>
import { Link } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

defineProps({
    tabs: Array
})

const tabSelect = (event) => {
    router.visit(event.target.value)
}
</script>

<template>
    <div>
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select a tab</label>
            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
            <select id="tabs"
                    name="tabs"
                    class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    @change="tabSelect($event)">
                <option v-for="tab in tabs" :key="tab.name" :selected="tab.current" :value="tab.url">{{ tab.name }}</option>
            </select>
        </div>
        <div class="hidden sm:block">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <Link v-for="tab in tabs" :key="tab.name" :href="tab.url" :class="[tab.current ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium']" :aria-current="tab.current ? 'page' : undefined">{{ tab.name }}</Link>
                </nav>
            </div>
        </div>
    </div>
</template>
