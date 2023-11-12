<script setup>
import { Head, Link } from '@inertiajs/vue3';
import LinkButton from "@/Components/Buttons/LinkButton.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div class="relative isolate overflow-hidden bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 pb-24 pt-10 sm:pb-32 lg:flex lg:px-8 lg:py-40">
            <div class="mx-auto max-w-2xl flex-shrink-0 lg:mx-0 lg:max-w-xl lg:pt-8">
                <h1 class="mt-10 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                    Dynastatracker
                </h1>
                <p class="mt-6 text-lg leading-8 text-gray-700">
                    Remember the glory of your football dynasty by tracking your stats, scores, and awards.
                </p>
                <div v-if="canLogin" class="mt-10 flex items-center gap-x-3">
                    <LinkButton v-if="$page.props.auth.user" :to="route('dynasty.index')">Dashboard</LinkButton>
                    <template v-else>
                        <LinkButton :to="route('login')">Login</LinkButton>
                        <LinkButton :to="route('register')" type="secondary">Register <span aria-hidden="true">→</span></LinkButton>
                    </template>
                </div>
            </div>
            <div class="mx-auto mt-16 flex max-w-2xl sm:mt-24 lg:ml-10 lg:mr-0 lg:mt-0 lg:max-w-none lg:flex-none xl:ml-32">
                <div class="max-w-3xl flex-none sm:max-w-5xl lg:max-w-none">
                    <img src="/dashboard.png" alt="App screenshot" width="2432" height="1442" class="w-[76rem] rounded-md bg-white/5 shadow-2xl ring-1 ring-white/10" />
                </div>
            </div>
        </div>
    </div>
</template>
