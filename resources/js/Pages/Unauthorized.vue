<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            Unauthorized
        </template>

        You do not have access
    </AuthenticatedLayout>
</template>
