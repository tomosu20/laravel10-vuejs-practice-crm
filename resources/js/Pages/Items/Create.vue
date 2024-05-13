<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';

defineProps({ errors: Object })

const form = useForm({
    name: null,
    memo: null,
    price: null,
})

const storeItem = () => {
    router.post('/items', form)
}

</script>

<template>

    <Head title="Add Item" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Item</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <BreezeValidationErrors :errors="errors" />
                    <section class="text-gray-600 body-font relative">
                        <form @submit.prevent="storeItem">
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
                                        <div class="p-2 w-full mt-2">
                                            <Link as="button" class="mr-2" :href="route('items.index')">
                                            <SecondaryButton><svg class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                    <path d="M12 5l-7 7+7 7"></path>
                                                </svg>
                                                back</SecondaryButton>
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
