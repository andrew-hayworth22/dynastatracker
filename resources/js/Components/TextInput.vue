<script setup>
import {onMounted, ref} from 'vue';

defineProps({
    modelValue: String|Number,
    hasErrors: Boolean
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({focus: () => input.value.focus()});
</script>

<template>
    <input ref="input"
           :class="{'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6' : true,
                    'text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500': hasErrors}"
           :value="modelValue"
           :aria-invalid="hasErrors"
           :aria-describedby="hasErrors ? 'email-error' : null"
           @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
