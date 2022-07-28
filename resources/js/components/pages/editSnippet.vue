<script setup>
import {onMounted, ref} from 'vue';
import {useRouter, useRoute } from 'vue-router';
import axios from "axios";
import ErrorsComponent from './errors.vue';

const childErrorsComponent = ref(null);
const Router = useRouter();
const Route = useRoute();
let errors = ref('');
let form = ref({
    id: '',
    title: '',
    description: '',
    snippet: ''
});

onMounted(async () => {
    getResource(Route.params.id);
});

const getResource = async (id) => {
    let response = await axios.get(`/api/resources/${id}/edit`);
    form.value.id = response.data.resource.id;
    form.value.title = response.data.resource.title;
    form.value.description = response.data.resource.description;
    form.value.snippet = response.data.resource.snippet;
}

const updateSnippet = () => {
    const formData = new FormData();
    formData.append('title', form.value.title);
    formData.append('description', form.value.description);
    formData.append('snippet', form.value.snippet);
    formData.append('type', 'snippet');
    formData.append('_method', 'PATCH');

    axios.post(`/api/resources/${Route.params.id}`, formData)
        .then((response) => {
            if (response.status === 202) {
                form.value.title = '';
                form.value.description = '';
                form.value.snippet = '';

                Router.push('/admin');

                toast.fire({
                    icon: 'success',
                    title: 'Snippet updated successfully'
                });
            }
        })
        .catch((error) => {
            errors.value = error.response.data.errors;
        });
}

const goBack = () => {
    Router.push('/admin');
}
</script>

<template>
    <div class="row mt-4">
        <div class="col-md-4 offset-md-4 border rounded p-5">
            <h2>Update HTML Snippet</h2>

            <form class="mt-4">
                <ErrorsComponent ref="childErrorsComponent" :errors="errors" />

                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" v-model="form.title">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Snippet Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description" rows="3" v-model="form.description"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="snippet" class="col-sm-2 col-form-label">HTML Snippet</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="snippet" rows="3" v-model="form.snippet"></textarea>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" @click="updateSnippet">Update HTML Snippet</button>
                <button type="button" class="btn btn-danger float-end" @click="goBack">Cancel</button>
            </form>
        </div>
    </div>
</template>
