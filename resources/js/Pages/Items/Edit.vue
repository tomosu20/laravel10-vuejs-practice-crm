<script setup>
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';

const props = defineProps({ item: Object, errors: Object })

const form = reactive({
    id: props.item.id,
    name: props.item.name,
    memo: props.item.memo,
    price: props.item.price,
    is_selling: props.item.is_selling,
})

const updateItem = id => {
    router.put(route('items.update', { item: id }), form)
}

</script>

<template>

    <Head title="Edit Item" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Item</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <BreezeValidationErrors :errors="errors" />
                    <section class="text-gray-600 body-font relative">
                        <form @submit.prevent="updateItem(form.id)">
                            <div class="container px-5 py-8 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <div class="flex flex-wrap -m-2">
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                                                <input type="text" id="name" name="name" v-model="form.name"
                                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                <div class="text-red-600" v-if="errors.name">{{ errors.name }}</div>
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="memo" class="leading-7 text-sm text-gray-600">Memo</label>
                                                <textarea id="memo" name="memo" v-model="form.memo"
                                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                                <div class="text-red-600" v-if="errors.memo">{{ errors.memo }}</div>
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="price" class="leading-7 text-sm text-gray-600">Price</label>
                                                <input type="number" id="price" name="price" v-model="form.price"
                                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                <div class="text-red-600" v-if="errors.price">{{ errors.price }}</div>
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="is_selling"
                                                    class="leading-7 text-sm text-gray-600">Status</label>
                                                <div>
                                                    <input type="radio" name="is_selling" v-model="form.is_selling"
                                                        value="1" id="select_radio1">
                                                    <label for="select_radio1" class="ml-2 mr-4">販売中</label>
                                                    <input type="radio" name="is_selling" v-model="form.is_selling"
                                                        value="0" id="select_radio2">
                                                    <label for="select_radio2" class="ml-2 mr-4">停止中</label>
                                                </div>
                                                <div class="text-red-600" v-if="errors.is_selling">{{ errors.is_selling
                                                    }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 flex">
                                            <Link as="button" :href="route('items.show', { item: item.id })"
                                                class="mr-4 mx-auto rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-center text-lg text-indigo-400 shadow-sm transition-all hover:bg-gray-100 focus:ring focus:ring-gray-100 disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-50 disabled:text-gray-400">
                                            Cancel</Link>
                                            <button
                                                class="mr-4 mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
