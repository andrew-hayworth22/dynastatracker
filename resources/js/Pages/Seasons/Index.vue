<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";
import EmptyState from "@/Components/EmptyState.vue";
import ListItem from "@/Components/ListItem.vue";
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    dynasty: {
        type: Object,
        required: true,
    },
    seasons: {
        type: Array,
        required: true,
    },
});

</script>

<template>
    <AppLayout :title="`${dynasty.name} Seasons`">
        <DynastyHeader :dynasty="dynasty" />

        <template v-if="seasons.length > 0">
            <ul role="list" class="divide-y divide-gray-100">
                <ListItem v-for="season in seasons" :key="season.id" class="last-of-type:rounded-b-md">
                    <template #title>
                        <Link :href="route('seasons.show', season.id)">
                            {{ season.year }}
                        </Link>
                    </template>
                    <template #subtitle>
                        {{ season.coach_type + " at " + season.team.college_abbreviation }}
                    </template>
                </ListItem>
            </ul>
            <PrimaryButtonLink :href="route('dynasties.seasons.create', dynasty.id)" class="mt-6">
                Create Season
            </PrimaryButtonLink>
        </template>
        <EmptyState v-else>
            <template #title>
                No seasons
            </template>
            <template #body>
                Get started by creating your first season!
            </template>
            <template #actions>
                <PrimaryButtonLink :href="route('dynasties.seasons.create', dynasty.id)">
                    Create Season
                </PrimaryButtonLink>
            </template>
        </EmptyState>
    </AppLayout>
</template>
