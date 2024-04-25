<template>
    <div class="bg-white sm:rounded-lg sm:shadow">
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
            <div class="flex flex-wrap items-center justify-between sm:flex-nowrap">
                <h3 class="text-base font-semibold leading-6 text-gray-900">
                    <slot name="title"/>
                </h3>
                <div class="flex-shrink-0">
                    <slot name="actions"/>
                </div>
            </div>
        </div>
        <div class="px-4 sm:px-6 py-4">
            <slot/>
        </div>
    </div>
</template>
<script setup>
</script>
