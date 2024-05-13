<script setup>
const props = defineProps({
    type: {
        type: String,
        default: 'button',
    },
    colorPattern: {
        type: String,
        default: 'default',
    }
});

const getColor = () => {
    if (props.colorPattern === 'indigo') {
        return 'bg-indigo-400 text-white hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900'
    }
    return 'bg-white text-gray-700 hover:bg-gray-50'
}

</script>

<template>
    <button :type="type" :class="getColor()"
        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs  uppercase tracking-widest shadow-sm  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
