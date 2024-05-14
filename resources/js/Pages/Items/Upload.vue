<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';

const uploadedFile = ref(null);
const uploadedData = ref(null);

const handleFileUpload = (event) => {
    uploadedFile.value = event.target.files[0];
};

const uploadData = () => {
    const formData = new FormData();
    formData.append('csvFile', uploadedFile.value);

    axios.post(route('items.csvImport'), formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(response => {
            uploadedData.value = response.data;
        })
        .catch(error => {
            console.error('Upload failed:', error);
        });
};
</script>


<template>

    <Head title="Import" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">CSV Import Item</h2>
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
                                            <div class="content">
                                                <InputLabel class="my-2" value="Select File" />
                                                <input id="csvFile" type="file" @change="handleFileUpload"
                                                    accept=".csv">
                                                <PrimaryButton @click="uploadData">
                                                    Upload
                                                </PrimaryButton>
                                            </div>
                                            <div class="my-6" v-if="uploadedData">
                                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                                    <thead>
                                                        <tr>
                                                            <th
                                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                                Name</th>
                                                            <th
                                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                                Memo</th>
                                                            <th
                                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                                Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="item in uploadedData">
                                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                                {{ item.name }}
                                                            </td>
                                                            <td class="border-t-2 border-b-2 border-gray-200 px-4 py-3">
                                                                {{ item.memo }}
                                                            </td>
                                                            <td
                                                                class="border-t-2 border-b-2 border-gray-200 px-4 py-3 text-lg text-gray-900">
                                                                {{ item.price }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
