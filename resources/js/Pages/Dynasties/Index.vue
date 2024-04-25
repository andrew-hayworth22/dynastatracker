<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import Tag from "@/Components/Tag.vue";
import SecondaryButtonLink from "@/Components/SecondaryButtonLink.vue";
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
import {Link} from "@inertiajs/vue3";
import EmptyState from "@/Components/EmptyState.vue";
import ListItem from "@/Components/ListItem.vue";

defineProps({
    dynasties: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="Dynasties">
        <div class="flex justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">
                Dynasties
            </h1>

            <PrimaryButtonLink v-if="dynasties.data.length > 0" :href="route('dynasties.create')">
                Create Dynasty
            </PrimaryButtonLink>
        </div>


        <template v-if="dynasties.data.length > 0">
            <ul role="list" class="divide-y divide-gray-100">
                <ListItem v-for="dynasty in dynasties.data" :key="dynasty.id">
                    <template #title>
                        <Link :href="route('dynasties.show', dynasty.id)">
                            {{ dynasty.name }}
                        </Link>
                    </template>
                    <template #tag>
                        <Tag :color="dynasty.is_active ? 'green' : 'orange'">
                            {{ dynasty.is_active ? 'Active' : 'Archived' }}
                        </Tag>
                    </template>
                    <template #subtitle>
                        Coached by {{ dynasty.coach_name }}
                    </template>
                </ListItem>
            </ul>

            <Pagination :meta="dynasties.meta" :only="['dynasties']"/>
        </template>
        <EmptyState v-else>
            <template #title>
                No dynasties
            </template>
            <template #body>
                Get started by creating your first dynasty!
            </template>
            <template #actions>
                <PrimaryButtonLink :href="route('dynasties.create')">
                    Create Dynasty
                </PrimaryButtonLink>
            </template>
        </EmptyState>
    </AppLayout>
</template>
