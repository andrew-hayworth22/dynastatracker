<script setup>
import Button from "@/Components/Buttons/Button.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/Input/InputLabel.vue";
import InputError from "@/Components/Input/InputError.vue";
import TextInput from "@/Components/Input/TextInput.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    'divisionId': {
        type: Number
    }
})

let showModal = ref(false)

const form = useForm({
    'college_name': '',
    'abbrev_college_name': '',
    'mascot_name': '',
    'location': ''
})

function createTeam() {
    form.post(route('team.store', { divisionId: props.divisionId }), {
        onSuccess: () => {
            form.reset()
            showModal.value = false
        }
    })
}
</script>

<template>
    <Button @click="showModal = true" size="xs">
        Add Team
    </Button>

    <Modal :show="showModal" @close="showModal = false">
        <template #title>
            Create Team
        </template>

        <form @submit.prevent="createTeam">
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
                <Button type="submit" :loading="form.processing">Save</Button>
                <Button type="button" color="secondary" @click="showModal = false">Cancel</Button>
            </div>
        </form>
    </Modal>
</template>

<style scoped>

</style>
