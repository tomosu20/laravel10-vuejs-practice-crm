<script setup>
import FlashMessage from '@/Components/FlashMessage.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ items: Array })
</script>

<template>

    <Head title="Items" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Items</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                            <FlashMessage />
                            <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                                <Link as="button" :href="route('items.upload')" class="flex ml-auto">
                                <SecondaryButton color-pattern="indigo">
                                    CSV
                                </SecondaryButton>
                                </Link>
                                <Link as="button" :href="route('items.create')" class="flex ml-2">
                                <SecondaryButton color-pattern="indigo">
                                    Add Item
                                </SecondaryButton>
                                </Link>
                            </div>
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                ID
                                            </th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Name</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Memo</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Price</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in items" :key="item.id">
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">

                                                {{ item.id }}
                                            </td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                <Link class="text-blue-400"
                                                    :href="route('items.show', { item: item.id })">
                                                {{ item.name }}
                                                </Link>
                                            </td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">{{ item.memo }}
                                            </td>
                                            <td
                                                class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-lg text-gray-900">
                                                {{
                                                    item.price }}</td>
                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                <span v-if="item.is_selling === 1">販売中</span>
                                                <span v-if="item.is_selling === 0">停止中</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
