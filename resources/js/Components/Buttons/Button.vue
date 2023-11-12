<script setup>
defineProps({
    color: {
        type: String,
        default: 'primary'
    },
    size: {
        type: String,
        default: 'base'
    },
    loading: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['click'])

</script>

<template>
    <button
        :class="{
            'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600': color === 'primary',
            'bg-white text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50': color === 'secondary',
            'bg-red-600 text-white hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600': color === 'error',
            'rounded-md px-3 py-2 text-sm font-semibold shadow-sm': size === 'base',
            'rounded px-2 py-1 text-sm font-semibold shadow-sm': size === 's',
            'rounded px-2 py-1 text-xs font-semibold shadow-sm': size === 'xs'
        }"
        :disabled="loading"
        @click="emit('click')"
    >
        <span v-show="loading" :class="{
            'loader': true,
            'xs' : size === 'xs'
        }"></span>
        <slot/>
    </button>
</template>
