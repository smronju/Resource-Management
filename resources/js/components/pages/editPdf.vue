<script setup>
import {onMounted, ref} from 'vue';
import { useRouter, useRoute } from 'vue-router';
import axios from "axios";
import ErrorsComponent from './errors.vue';

const childErrorsComponent = ref(null);
const Router = useRouter();
const Route = useRoute();
let errors = ref('');
let form = ref({
    id: '',
    title: '',
    pdf: ''
});

onMounted(async () => {
    getResource();
});

const getResource = async () => {
    let response = await axios.get(`/api/resources/${Route.params.id}/edit`);
    form.value.id = response.data.resource.id;
    form.value.title = response.data.resource.title;
}


const updatePDF = (event) => {
    const formData = new FormData();
    formData.append('title', form.value.title);
    formData.append('file', form.value.pdf);
    formData.append('type', 'pdf');
    formData.append('_method', 'PATCH');

    axios.post(`/api/resources/${Route.params.id}`, formData)
        .then((response) => {
            if (response.status === 202) {
                form.value.title = '';

                Router.push('/admin');

                toast.fire({
                    icon: 'success',
                    title: 'PDF updated successfully'
                });
            }
        })
        .catch((error) => {
            errors.value = error.response.data.errors;
        });
}

const uploadPDF = (event) => {
    let file = event.target.files[0];
    form.value.pdf = file;
}

const goBack = () => {
    Router.push('/admin');
}
</script>

<template>
    <div class="row mt-4">
        <div class="col-md-4 offset-md-4 border rounded p-5 ">
            <h2>Update PDF</h2>
            <form class="mt-4">
                <ErrorsComponent ref="childErrorsComponent" :errors="errors" />

                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" v-model="form.title">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="pdf" class="col-sm-2 col-form-label">Select a pdf file</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="pdf" @change="uploadPDF">
                    </div>
                </div>

                <button type="button" class="btn btn-primary" @click="updatePDF">Save PDF</button>
                <button type="button" class="btn btn-danger float-end" @click="goBack">Cancel</button>
            </form>
        </div>
    </div>
</template>
