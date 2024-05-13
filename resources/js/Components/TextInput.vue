<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    isMultiline: {
        type: Boolean,
        default: false,
    }
})

const model = defineModel({
    required: false,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <!-- TODO:type="text"のときのみisMultilineによる判定を行いたいが、知見がないため一旦スルー -->
    <textarea v-if="props.isMultiline"
        class="bg-opacity-50 rounded-md border-gray-300 focus:border-indigo-500 focus:bg-white  focus:ring-indigo-500 text-base outline-none py-1 px-3 leading-6 transition-colors duration-200 ease-in-out shadow-sm resize-none"
        v-model="model" ref="input" />
    <input v-else class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        v-model="model" ref="input" />
</template>
