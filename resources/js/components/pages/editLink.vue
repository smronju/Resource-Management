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
    link: '',
    newTab: false,
});

onMounted(async () => {
    getResource(Route.params.id);
});

const getResource = async (id) => {
    let response = await axios.get(`/api/resources/${id}/edit`);
    form.value.id = response.data.resource.id;
    form.value.title = response.data.resource.title;
    form.value.link = response.data.resource.link;
    form.value.newTab = response.data.resource.new_tab;
}

const updateLink = () => {
    const formData = new FormData();
    formData.append('id', form.value.id);
    formData.append('_method', 'PATCH');
    formData.append('title', form.value.title);
    formData.append('link', form.value.link);
    formData.append('new_tab', (form.value.newTab === true) ? 1 : 0);
    formData.append('type', 'link');

    axios.post(`/api/resources/${Route.params.id}`, formData)
        .then((response) => {
            if (response.status === 202) {
                form.value.title = '';
                form.value.link = '';
                form.value.newTab = '';

                Router.push('/admin');

                toast.fire({
                    icon: 'success',
                    title: 'Link updated successfully'
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
            <h2>Update Link</h2>

            <form class="mt-4">
                <ErrorsComponent ref="childErrorsComponent" :errors="errors"/>

                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" required v-model="form.title">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="link" class="col-sm-2 col-form-label">Link</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="link" required v-model="form.link">
                        <div class="invalid-feedback">Please choose a username.</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="newTab" value="1" v-model="form.newTab" :checked="form.newTab">
                            <label class="form-check-label" for="newTab">
                                Open in a new tab
                            </label>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" @click="updateLink">Update Resource</button>
                <button type="button" class="btn btn-danger float-end" @click="goBack">Cancel</button>
            </form>
        </div>
    </div>
</template>
