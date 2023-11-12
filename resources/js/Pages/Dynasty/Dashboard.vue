<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import {Head, useForm} from '@inertiajs/vue3'
import Button from "@/Components/Buttons/Button.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";

defineProps({
    'dynasty': Object
})

let showDeleteModal = ref(false)
const deleteForm = useForm({})
</script>

<template>
    <Head :title="dynasty.name"/>

    <AuthenticatedLayout :dynastyId="dynasty.id">
      <template #header>
        {{ dynasty.name }}
      </template>
      <template #buttons>
        <Button color="error" @click="showDeleteModal = true">Delete</Button>
      </template>

      <Modal :show="showDeleteModal" @close="showDeleteModal = false">
        <template #title>
          Are you sure you want to delete your dynasty? This is permanent!
        </template>
        <div class="flex gap-2">
          <form @submit.prevent="deleteForm.delete(route('dynasty.destroy', {id: dynasty.id}))">
            <Button color="error" :loading="deleteForm.processing">Permanently Delete</Button>
          </form>
          <Button color="secondary" @click="showDeleteModal = false">Cancel</Button>
        </div>
      </Modal>
    </AuthenticatedLayout>
</template>
