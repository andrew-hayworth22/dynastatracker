<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";

defineProps({
    dynasty: {
        type: Object,
        required: true,
    },
    season: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="Dynasties">
        <DynastyHeader :dynasty="dynasty" />

        <div class="grid grid-cols-[1fr_500px] gap-4">
            <div class="bg-amber-500">
                Left Column
            </div>
            <div class="bg-pink-500">
                Right Column
            </div>
        </div>
    </AppLayout>
</template>
