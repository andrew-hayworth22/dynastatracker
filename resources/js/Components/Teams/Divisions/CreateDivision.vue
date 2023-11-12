<script setup>
import Button from "@/Components/Buttons/Button.vue";
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/Input/InputLabel.vue";
import InputError from "@/Components/Input/InputError.vue";
import TextInput from "@/Components/Input/TextInput.vue";

const props = defineProps({
    'conferenceId': {
        type: Number
    }
})

const emit = defineEmits(['created'])

let showModal = ref(false)

const form = useForm({
    name: ''
})

function createDivision() {
    form.post(route('division.store', { conferenceId: props.conferenceId }), {
        onSuccess: () => {
            form.reset()
            showModal.value = false
            emit('created')
        }
    })
}
</script>

<template>
    <Button @click="showModal=true" size="s">Create Division</Button>

    <Modal :show="showModal" @close="showModal=false">
        <template #title>
            Create Division
        </template>

        <form @submit.prevent="createDivision">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="flex gap-2 mt-4">
                <Button type="submit" :loading="form.processing">Save</Button>
                <Button type="button" color="secondary" @click="showModal = false">Cancel</Button>
            </div>
        </form>
    </Modal>
</template>

<style scoped>

</style>
