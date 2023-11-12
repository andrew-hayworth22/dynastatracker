<script setup>
import Button from "@/Components/Buttons/Button.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/Input/InputLabel.vue";
import InputError from "@/Components/Input/InputError.vue";
import TextInput from "@/Components/Input/TextInput.vue";

const props = defineProps({
    'dynastyId': {
        type: Number
    }
})

let showModal = ref(false)

const form = useForm({
    'name': '',
    'abbreviation': ''
})

function createConference() {
    form.post(route('conference.store', { dynastyId: props.dynastyId }), {
        onSuccess: () => {
            form.reset()
            showModal.value = false
        }
    })
}
</script>

<template>
    <Button @click="showModal = true">Create Conference</Button>

    <Modal :show="showModal" @close="showModal = false">
        <template #title>
            Create Conference
        </template>

        <form @submit.prevent="createConference">
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

            <div>
                <InputLabel for="abbreviation" value="Abbreviation" />

                <TextInput
                    id="abbreviation"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.abbreviation"
                    required
                />

                <InputError class="mt-2" :message="form.errors.abbreviation" />
            </div>

            <div class="flex gap-2 mt-4">
                <Button type="submit" :loading="form.processing">Save</Button>
                <Button type="button" color="secondary" @click="showModal = false">Cancel</Button>
            </div>
        </form>
    </Modal>
</template>
