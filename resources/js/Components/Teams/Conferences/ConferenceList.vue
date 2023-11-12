<script setup>
import Conference from "@/Components/Teams/Conferences/Conference.vue";
import EmptyState from "@/Components/EmptyState.vue";
import {inject} from "vue";
import CreateConference from "@/Components/Teams/Conferences/CreateConference.vue";
const dynastyId = inject('dynastyId')

defineProps({
    'conferences': Array
})
</script>

<template>
    <div>
        <template v-if="conferences.length">
            <Conference v-for="conference in conferences" :conference="conference" :key="conference.id"/>
        </template>
        <template v-else>
            <EmptyState>
                <template #title>
                    No conferences
                </template>
                <template #body>
                    Get started by creating a conference
                </template>
                <template #buttons>
                    <CreateConference :dynastyId="dynastyId"/>
                </template>
            </EmptyState>
        </template>
    </div>
</template>
