<script setup>
defineProps({
  disablePadding: {
    type: Boolean,
    default: false
  }
})
</script>

<template>
  <div :class="[{'p-4 sm:p-8': !disablePadding}, 'bg-white shadow sm:rounded-lg']">
    <slot/>
  </div>
</template>
