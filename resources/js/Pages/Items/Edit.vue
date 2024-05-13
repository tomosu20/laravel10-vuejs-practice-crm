<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({ item: Object, errors: Object })

const form = useForm({
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
                                                <InputLabel for="name" value="Name" />
                                                <TextInput id="name" type="text" class="mt-1 block w-full"
                                                    v-model="form.name" autofocus autocomplete="name" />
                                                <InputError :message="errors.name" />
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <InputLabel for="memo" value="Memo" />
                                                <TextInput id="memo" type="text" class="mt-1 block w-full h-32"
                                                    v-model="form.memo" autocomplete="memo" :is-multiline="true" />
                                                <InputError :message="errors.memo" />
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <InputLabel for="price" value="Price" />
                                                <TextInput id="price" type="number" class="mt-1 block w-full"
                                                    v-model="form.price" autocomplete="price" />
                                                <InputError :message="errors.price" />
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <InputLabel for="is_selling" value="Status" />
                                                <div>
                                                    <input type="radio" name="is_selling" v-model="form.is_selling"
                                                        value="1" id="select_radio1">
                                                    <label for="select_radio1" class="ml-2 mr-4">販売中</label>
                                                    <input type="radio" name="is_selling" v-model="form.is_selling"
                                                        value="0" id="select_radio2">
                                                    <label for="select_radio2" class="ml-2 mr-4">停止中</label>
                                                </div>
                                                <InputError :message="errors.is_selling" />
                                            </div>
                                        </div>
                                        <div class="p-2 flex mt-2">
                                            <Link as="button" :href="route('items.show', { item: item.id })">
                                            <SecondaryButton class="mr-2" :disabled="form.processing">
                                                Cancel
                                            </SecondaryButton>
                                            </Link>
                                            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
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
