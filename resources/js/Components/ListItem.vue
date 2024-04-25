<template>
    <li class="flex items-center justify-between gap-x-6 py-5 px-4 sm:px-6 bg-white first-of-type:rounded-t-md shadow-sm">
        <div class="min-w-0">
            <div class="flex items-start gap-x-3">
                <p class="text-sm font-semibold leading-6 text-gray-900">
                    <slot name="title"/>
                </p>
                <slot name="tag"/>
            </div>
            <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                <slot name="subtitle"/>
            </div>
        </div>
    </li>
</template>
