<script setup>
import {Link} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    field: {
        type: String,
        required: true,
    },
    values: {
        type: Array,
        required: true,
    },
    url: {
        type: String,
        required: true,
    },
    filter: {
        type: Object,
        required: true,
    },
    only: {
        type: Array,
        required: false,
    },
});

const queryString = computed(() => {
    let result = '?';

    for(const key in props.filter) {
        if (props.key !== props.field)
            result += `filter[${key}]=${props.filter[key]}&`;
    }

    return result;
});

</script>

<template>
  <div class="divide-x shadow-sm">
    <Link v-for="value in values"
          :class="{'inline-block px-3 py-1 first-of-type:rounded-l-md last-of-type:rounded-r-md' : true,
                   'bg-blue-500 text-white': filter[field] === value,
                   'bg-white': filter[field] !== value}"
          :href="url + queryString + `filter[${field}]=${value}`"
          :only="[...only, 'filter']"> {{ value }}
    </Link>
  </div>
</template>
