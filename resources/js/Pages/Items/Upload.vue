<script setup>
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
            console.log(response.data);
        })
        .catch(error => {
            console.error('Upload failed:', error);
        });
};
</script>


<template>

    <Head title="CSV Import Item" />

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
                                                <h1>File Upload</h1>
                                                <input id="csvFile" type="file" @change="handleFileUpload"
                                                    accept=".csv">
                                                <button @click="uploadData">Upload</button>
                                            </div>
                                            <!-- TODO: 登録前と後のデータを表示させたい -->

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
