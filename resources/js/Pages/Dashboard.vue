<script setup>
import {Head} from '@inertiajs/vue3';
import DynastyList from "@/Components/Dynasties/DynastyList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {usePage} from "@inertiajs/vue3";
import Card from "@/Components/Card.vue";

const dynasties = usePage().props.dynasties
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Dashboard
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Card class="px-4 pb-4" disable-padding>
                  <DynastyList :dynasties="dynasties"/>
                </Card>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
