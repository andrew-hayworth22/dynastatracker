<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DynastyHeader from "@/Components/DynastyHeader.vue";
import EmptyState from "@/Components/EmptyState.vue";
import ListItem from "@/Components/ListItem.vue";
import {Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PrimaryButtonLink from "@/Components/PrimaryButtonLink.vue";
import Slideout from "@/Components/Slideout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputSelect from "@/Components/InputSelect.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    dynasty: {
        type: Object,
        required: true,
    },
    season: {
        type: Object,
        required: true,
    }
});
</script>

<template>
    <AppLayout :title="`${dynasty.name} Seasons`">
        <DynastyHeader :dynasty="dynasty" />
        {{ season.name }}
    </AppLayout>
</template>
