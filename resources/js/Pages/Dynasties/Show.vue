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
    <AppLayout title="Dynasties">
        <DynastyHeader :dynasty="dynasty" />

    </AppLayout>
</template>
