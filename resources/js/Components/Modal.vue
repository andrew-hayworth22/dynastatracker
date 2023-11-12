<script setup>
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'
import {onMounted, onUnmounted} from "vue";

const props = defineProps({
  show: {
    type: Boolean
  }
})

const emit = defineEmits(['close'])

const close = () => {
  emit('close');
}
</script>

<template>
  <Teleport to="body">
    <TransitionRoot appear :show="show" as="template">
      <Dialog as="div" class="relative z-10" @close="close">
        <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100"
            leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-gray-900/75"/>
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div
              class="flex min-h-full items-center justify-center p-4 text-center"
          >
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0 scale-95"
                enter-to="opacity-100 scale-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100 scale-100"
                leave-to="opacity-0 scale-95"
            >
              <DialogPanel
                  class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
              >
                <DialogTitle
                    as="h3"
                    class="text-lg font-medium leading-6 text-gray-900"
                >
                  <slot name="title"/>
                </DialogTitle>

                <hr class="my-4"/>

                <slot/>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </Teleport>
</template>

<!--<script setup>-->
<!--import { computed, onMounted, onUnmounted, watch } from 'vue';-->
<!--import { FocusTrap } from "@headlessui/vue";-->

<!--const props = defineProps({-->
<!--    show: {-->
<!--        type: Boolean,-->
<!--        default: false,-->
<!--    },-->
<!--    maxWidth: {-->
<!--        type: String,-->
<!--        default: '2xl',-->
<!--    },-->
<!--    closeable: {-->
<!--        type: Boolean,-->
<!--        default: true,-->
<!--    },-->
<!--});-->

<!--const emit = defineEmits(['close']);-->

<!--watch(-->
<!--    () => props.show,-->
<!--    () => {-->
<!--        if (props.show) {-->
<!--            document.body.style.overflow = 'hidden';-->
<!--        } else {-->
<!--            document.body.style.overflow = null;-->
<!--        }-->
<!--    }-->
<!--);-->

<!--const close = () => {-->
<!--    if (props.closeable) {-->
<!--        emit('close');-->
<!--    }-->
<!--};-->

<!--const closeOnEscape = (e) => {-->
<!--    if (e.key === 'Escape' && props.show) {-->
<!--        close();-->
<!--    }-->
<!--};-->

<!--onMounted(() => document.addEventListener('keydown', closeOnEscape));-->

<!--onUnmounted(() => {-->
<!--    document.removeEventListener('keydown', closeOnEscape);-->
<!--    document.body.style.overflow = null;-->
<!--});-->

<!--const maxWidthClass = computed(() => {-->
<!--    return {-->
<!--        sm: 'sm:max-w-sm',-->
<!--        md: 'sm:max-w-md',-->
<!--        lg: 'sm:max-w-lg',-->
<!--        xl: 'sm:max-w-xl',-->
<!--        '2xl': 'sm:max-w-2xl',-->
<!--    }[props.maxWidth];-->
<!--});-->
<!--</script>-->

<!--<template>-->
<!--    <Teleport to="body">-->
<!--        <Transition leave-active-class="duration-200">-->
<!--            <div v-show="show" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" scroll-region>-->
<!--                <Transition-->
<!--                    enter-active-class="ease-out duration-300"-->
<!--                    enter-from-class="opacity-0"-->
<!--                    enter-to-class="opacity-100"-->
<!--                    leave-active-class="ease-in duration-200"-->
<!--                    leave-from-class="opacity-100"-->
<!--                    leave-to-class="opacity-0"-->
<!--                >-->
<!--                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">-->
<!--                        <div class="absolute inset-0 bg-gray-500 opacity-75" />-->
<!--                    </div>-->
<!--                </Transition>-->

<!--                <Transition-->
<!--                    enter-active-class="ease-out duration-300"-->
<!--                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"-->
<!--                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"-->
<!--                    leave-active-class="ease-in duration-200"-->
<!--                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"-->
<!--                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"-->
<!--                >-->
<!--                    <div-->
<!--                        v-show="show"-->
<!--                        class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto"-->
<!--                        :class="maxWidthClass"-->
<!--                    >-->
<!--                        <slot v-if="show" />-->
<!--                    </div>-->
<!--                </Transition>-->
<!--            </div>-->
<!--        </Transition>-->
<!--    </Teleport>-->
<!--</template>-->
