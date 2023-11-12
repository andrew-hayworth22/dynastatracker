<script setup>
import Modal from '@/components/Modal.vue';
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/Input/TextInput.vue";
import InputError from "@/Components/Input/InputError.vue";
import InputLabel from "@/Components/Input/InputLabel.vue";
import Button from "@/Components/Buttons/Button.vue";

let showModal = ref(false)

const form = useForm({
    name: '',
    coach_name: ''
})

function createDynasty() {
    form.post(route('dynasty.store'), {
        onSuccess: () => {
            form.reset()
            showModal.value = false
        }
    })
}
</script>

<template>
    <Button @click="showModal = true">
        Create Dynasty
    </Button>

    <Modal :show="showModal" @close="showModal=false">
      <template #title>Create Dynasty</template>
        <div class="text-gray-900 dark:text-gray-100">
            <form @submit.prevent="createDynasty">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="coach_name" value="Coach Name" />

                    <TextInput
                        id="coach_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.coach_name"
                        required
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.coach_name" />
                </div>

              <div class="flex gap-2 mt-4">
                <Button type="submit" :loading="form.processing">Save</Button>
                <Button type="button" color="secondary" @click="showModal = false">Cancel</Button>
              </div>
            </form>
        </div>
    </Modal>
</template>
