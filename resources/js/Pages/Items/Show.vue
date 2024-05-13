<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ShowText from '@/Components/ShowText.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({ item: Object })

const deleteItem = id => {
    router.delete(route('items.destroy', { item: id }), {
        onBefore: () => confirm('Is Really, delete item?')
    })
}

</script>

<template>

    <Head title="Show Item" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Show Item</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-8 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <div class="flex flex-wrap -m-2">
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <InputLabel for="name" value="Name" />
                                            <ShowText :value="item.name" />
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <InputLabel for="memo" value="Memo" />
                                            <ShowText :is-multiline="true" :value="item.memo" />
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <InputLabel for="price" value="Price" />
                                            <ShowText :value="item.price" />
                                        </div>
                                    </div>
                                    <div class="p-2 w-full">
                                        <div class="relative">
                                            <InputLabel for="is_selling" value="Status" />
                                            <ShowText v-if="item.is_selling === 1" value="販売中" />
                                            <ShowText v-if="item.is_selling === 0" value="停止中" />
                                        </div>
                                    </div>

                                    <div class="p-2 flex mt-2">
                                        <Link as="button" class="mr-2" :href="route('items.index')">
                                        <SecondaryButton><svg class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                                <path d="M12 5l-7 7+7 7"></path>
                                            </svg>
                                            back</SecondaryButton>
                                        </Link>
                                        <Link as="button" class="mr-2" :href="route('items.edit', { item: item.id })">
                                        <SecondaryButton color-pattern="indigo">edit</SecondaryButton>
                                        </Link>
                                        <DangerButton @click="deleteItem(item.id)">delete</DangerButton>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
