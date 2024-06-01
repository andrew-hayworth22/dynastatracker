<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";
import {Link} from "@inertiajs/vue3";
import Card from "@/Components/Card.vue";
import EmptyState from "@/Components/EmptyState.vue";
import {ref, useSlots} from "vue";
import SeasonSidebar from "@/Components/SeasonSidebar.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DashboardLink from "@/Components/DashboardLink.vue";

defineProps({
    dynasty: {
        type: Object,
        required: true,
    },
    seasons: {
        type: Array,
        required: true,
    },
    teams: {
        type: Array,
        required: true,
    },
    coachTypes: {
        type: Array,
        required: true,
    }
});

const showSeasonSidebar = ref(false);
</script>

<template>
    <AppLayout title="Dynasties" :selected_dynasty_id="dynasty.id">
        <DynastyHeader :dynasty="dynasty"/>

        <div class="grid xl:grid-cols-[1fr_500px] gap-4">
            <div class="flex flex-col gap-4">
                <Card :use-padding="false" class="overflow-hidden">
                    <template #title>
                        Seasons
                    </template>

                    <template #actions>
                        <PrimaryButton @click="showSeasonSidebar = true">
                            Create Season
                        </PrimaryButton>
                    </template>

                    <template v-if="seasons.length > 0">
                        <div class="flow-root">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full">
                                            <thead class="bg-gray-50 sr-only">
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Year</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Job</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Record</th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-for="season in seasons" :key="season.id">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                    <Link :href="route('seasons.show', season.id)">
                                                        {{ season.year }}
                                                    </Link>
                                                </td>
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                    {{ season.coach_type + ' @ ' + season.team.college_name }}
                                                </td>
                                                <td class="whitespace-nowrap pl-3 sm:pr-6 pr-4 py-4 text-sm text-gray-500 text-right">
                                                    {{ season.record }}
                                                </td>
                                            </tr>
                                            <tr v-if="seasons.length === 3">
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                    <Link :href="route('dynasties.seasons.index', dynasty.id)">
                                                        View all seasons
                                                    </Link>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    <EmptyState v-else>
                        <template #title>
                            No seasons yet...
                        </template>
                    </EmptyState>
                </Card>
            </div>

            <div class="flex flex-col gap-2">
                <DashboardLink :href="route('dynasties.conferences.index', dynasty.id)">
                    Manage Teams
                </DashboardLink>
                <DashboardLink :href="route('dynasties.players.index', dynasty.id)">
                    Manage Players
                </DashboardLink>
            </div>
        </div>

        <SeasonSidebar :teams="teams"
                       :dynasty-id="dynasty.id"
                       :open="showSeasonSidebar"
                       :coachTypes="coachTypes"
                       @close="showSeasonSidebar=false"
        />
    </AppLayout>
</template>
