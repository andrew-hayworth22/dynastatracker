<script setup>
import Button from "@/Components/Buttons/Button.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/Input/InputLabel.vue";
import InputError from "@/Components/Input/InputError.vue";
import TextInput from "@/Components/Input/TextInput.vue";

const props = defineProps({
    'team': {
        type: Object
    }
})

let showModal = ref(false);

const form = useForm({
    'college_name': props.team.college_name,
    'abbrev_college_name': props.team.abbrev_college_name,
    'mascot_name': props.team.mascot_name,
    'location': props.team.location
})

function updateTeam() {
    form.put(route('team.update', { id: props.team.id }), {
        onSuccess: () => {
            form.reset()
            showModal.value = false
        }
    })
}
</script>

<template>
    <Button @click="showModal = true" color="secondary" size="xs">Edit</Button>

    <Modal :show="showModal" @close="showModal = false">
        <template #title>
            Edit {{ team.abbrev_college_name }}
        </template>

        <form @submit.prevent="updateTeam">
            <div>
                <InputLabel for="college_name" value="College Name" />

                <TextInput
                    id="college_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.college_name"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.college_name" />
            </div>

            <div>
                <InputLabel for="abbrev_college_name" value="Abbreviated College Name" />

                <TextInput
                    id="abbrev_college_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.abbrev_college_name"
                    required
                />

                <InputError class="mt-2" :message="form.errors.abbrev_college_name" />
            </div>

            <div>
                <InputLabel for="mascot_name" value="Mascot Name" />

                <TextInput
                    id="mascot_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.mascot_name"
                    required
                />

                <InputError class="mt-2" :message="form.errors.mascot_name" />
            </div>

            <div>
                <InputLabel for="location" value="Location" />

                <TextInput
                    id="location"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.location"
                    required
                />

                <InputError class="mt-2" :message="form.errors.location" />
            </div>

            <div class="flex gap-2 mt-4">
                <Button type="submit" :loading="form.processing">Update</Button>
                <Button type="button" color="secondary" @click="showModal = false">Cancel</Button>
            </div>
        </form>
    </Modal>
</template>
