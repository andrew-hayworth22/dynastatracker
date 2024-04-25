<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    name: '',
    coach_name: '',
});

const createDynasty = () => {
    form.post(route('dynasties.store'));
};
</script>

<template>
    <AppLayout title="Create Dynasty">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">
            Create Dynasty
        </h1>

        <form @submit.prevent="createDynasty" class="flex flex-col gap-6 sm:w-1/2">
            <div>
                <InputLabel for="name">
                    Dynasty Name
                </InputLabel>
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    :has-errors="form.errors.name !== undefined"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div>
                <InputLabel for="coach_name">
                    Coach Name
                </InputLabel>
                <TextInput
                    id="coach_name"
                    v-model="form.coach_name"
                    type="text"
                    class="mt-1 block w-full"
                    :has-errors="form.errors.coach_name !== undefined"
                />
                <InputError :message="form.errors.coach_name" class="mt-2" />
            </div>

            <div>
                <PrimaryButton :disabled="form.processing">
                    Create
                </PrimaryButton>
            </div>
        </form>
    </AppLayout>
</template>
