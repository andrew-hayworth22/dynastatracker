<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";
import EmptyState from "@/Components/EmptyState.vue";
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
import Card from "@/Components/Card.vue";
import {Link} from "@inertiajs/vue3";
import BreadcrumbsItem from "@/Components/BreadcrumbsItem.vue";

defineProps({
    season: {
        type: Object,
        required: true,
    },
    games: {
        type: Array,
        required: true,
    }
});
</script>

<template>
    <AppLayout title="Dynasties" :selected_dynasty_id="season.dynasty.id">
        <DynastyHeader :dynasty="season.dynasty">
            <template #breadcrumbs>
                <BreadcrumbsItem :route="route('dynasties.seasons.index', season.dynasty.id)">
                    Seasons
                </BreadcrumbsItem>
                <BreadcrumbsItem :route="route('seasons.show', season.id)" :current="true">
                    {{ season.year }}
                </BreadcrumbsItem>
            </template>
        </DynastyHeader>

        <div class="grid xl:grid-cols-[1fr_500px] gap-4">
            <div class="flex flex-col gap-4">
                <Card>
                    <template #title>
                        {{ season.year }}
                    </template>

                    {{ season.coach_type + ' @ ' + season.team.college_name }}

                </Card>

                <Card :use-padding="false" class="overflow-hidden">
                    <template #title>
                        Schedule ({{ season.record }})
                    </template>

                    <template #actions>
                        <PrimaryButtonLink :href="route('seasons.games.create', season.id)">
                            Create Game
                        </PrimaryButtonLink>
                    </template>

                    <template v-if="games.length > 0">
                        <div class="flow-root">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full">
                                            <thead class="bg-gray-50 sr-only">
                                                <tr>
                                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Game</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Opponent</th>
                                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Result</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                                <tr v-for="game in games" :key="game.id">
                                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                        <Link :href="route('games.show', game.id)">
                                                            {{ game.type === 'Regular Season' ? 'Week ' + game.week : game.type }}
                                                        </Link>
                                                    </td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                        {{ (game.location === 'Away' ? '@ ' : '') + game.opp_team.college_name }}
                                                    </td>
                                                    <td class="whitespace-nowrap pl-3 sm:pr-6 pr-4 py-4 text-sm text-gray-500 text-right">
                                                        <span :class="{'text-green-500': game.our_score > game.opp_score, 'text-red-500': game.our_score <= game.opp_score}">
                                                            {{ (game.our_score > game.opp_score ? 'W' : 'L') + ' ' + game.our_score + '-' + game.opp_score }}
                                                        </span>
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
                            No games found
                        </template>
                    </EmptyState>
                </Card>
            </div>
            <div>
                <Card>

                </Card>
                <PrimaryButtonLink :href="route('seasons.roster', season.id)">
                    Roster
                </PrimaryButtonLink>
            </div>
        </div>
    </AppLayout>
</template>
