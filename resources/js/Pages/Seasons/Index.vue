<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";
import EmptyState from "@/Components/EmptyState.vue";
import ListItem from "@/Components/ListItem.vue";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import BreadcrumbsItem from "@/Components/BreadcrumbsItem.vue";
import SeasonSidebar from "@/Components/SeasonSidebar.vue";

const props = defineProps({
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
        required: true
    },
    coachTypes: {
        type: Array,
        required: true
    }
});

const showSidebar = ref(false);
</script>

<template>
    <AppLayout :title="`${dynasty.name} Seasons`" :selected_dynasty_id="dynasty.id">
        <DynastyHeader :dynasty="dynasty">
            <template #breadcrumbs>
                <BreadcrumbsItem :route="route('dynasties.seasons.index', dynasty.id)" :current="true">
                    Seasons
                </BreadcrumbsItem>
            </template>
        </DynastyHeader>

        <template v-if="seasons.length > 0">
            <ul role="list" class="divide-y divide-gray-100">
                <ListItem v-for="season in seasons" :key="season.id" class="last-of-type:rounded-b-md">
                    <template #title>
                        <Link :href="route('seasons.show', season.id)">
                            {{ season.year + ' (' + season.record + ')' }}
                        </Link>
                    </template>
                    <template #subtitle>
                        {{ season.coach_type + " at " + season.team.college_name }}
                    </template>
                </ListItem>
            </ul>
            <PrimaryButton @click="showSidebar = true" class="mt-6">
                Create Season
            </PrimaryButton>
        </template>
        <EmptyState v-else>
            <template #title>
                No seasons
            </template>
            <template #body>
                Get started by creating your first season!
            </template>
            <template #actions>
                <PrimaryButton @click="showSidebar = true">
                    Create Season
                </PrimaryButton>
            </template>
        </EmptyState>

        <SeasonSidebar :open="showSidebar"
                       :dynastyId="dynasty.id"
                       :teams="teams"
                       :coachTypes="coachTypes"
                       @close="showSidebar = false"/>
    </AppLayout>
</template>
