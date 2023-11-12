<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import SeasonList from "@/Components/Seasons/SeasonList.vue";

defineProps({
    'dynastyName': String,
    'dynastyId': Number,
    'seasons': Array
})
</script>

<template>
    <Head :title="dynastyName + ' |  Seasons'"/>

    <AuthenticatedLayout :dynastyId="dynastyId">
        <template #header> Seasons </template>

        <SeasonList :seasons="seasons"/>
    </AuthenticatedLayout>
</template>
