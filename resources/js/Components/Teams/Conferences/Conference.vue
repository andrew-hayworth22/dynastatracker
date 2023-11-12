<script setup>
import DivisionList from "@/Components/Teams/Divisions/DivisionList.vue"
import Button from "@/Components/Buttons/Button.vue"
import CreateDivision from "@/Components/Teams/Divisions/CreateDivision.vue"
import { ChevronDownIcon, ChevronUpIcon } from "@heroicons/vue/24/solid/index.js"
import {ref} from "vue"

defineProps({
    'conference': {
        type: Object
    }
})

let showDivisions = ref(false)
</script>

<template>
    <div>
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold">
                {{ conference.name }}
                <Button @click="showDivisions = !showDivisions" size="xs" color="secondary">
                    <ChevronDownIcon v-if="!showDivisions" class="h-3 w-3"></ChevronDownIcon>
                    <ChevronUpIcon v-else class="h-3 w-3"></ChevronUpIcon>
                </Button>
            </h2>
            <CreateDivision :conferenceId="conference.id" @created="showDivisions = true"/>
        </div>

        <hr class="my-2"/>
        <DivisionList
            v-show="showDivisions"
            :divisions="conference.divisions"
            :conferenceId="conference.id"
            :conferenceAbbreviation="conference.abbreviation"/>
    </div>
</template>

<style scoped>

</style>
