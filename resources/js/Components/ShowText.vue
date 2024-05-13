<script setup>

import { nl2br } from '@/common';

defineProps({
    value: {
        required: true,
    },
    isMultiline: {
        type: Boolean,
        default: false
    }
})

</script>

<template>
    <div v-if="isMultiline" v-html="nl2br(value)"
        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">
    </div>
    <div v-else
        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        {{ value }}</div>
</template>