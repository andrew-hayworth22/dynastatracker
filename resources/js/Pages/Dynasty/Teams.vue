<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ConferenceList from "@/Components/Teams/Conferences/ConferenceList.vue";
import CreateConference from "@/Components/Teams/Conferences/CreateConference.vue";

defineProps({
  'dynastyName': String,
  'dynastyId': Number,
  'conferences': Array
})
</script>

<template>
  <Head :title="dynastyName"/>

  <AuthenticatedLayout :dynastyId="dynastyId">
    <template #header>
      Teams
    </template>
    <template #buttons>
        <CreateConference v-if="conferences.length" :dynastyId="dynastyId"/>
    </template>

    <ConferenceList class="mt-8" :conferences="conferences"/>
  </AuthenticatedLayout>
</template>
