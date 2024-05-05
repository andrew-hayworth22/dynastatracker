<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";

defineProps({
    dynasty: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="Dynasties" :selected_dynasty_id="dynasty.id">
        <DynastyHeader :dynasty="dynasty" />

    </AppLayout>
</template>
