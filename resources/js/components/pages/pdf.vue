<script setup>
import moment from "moment";
import axios from "axios";
const props = defineProps(['resource', 'delete']);
defineEmits(['deleteResource']);

const deletePDF = () => {
    props.delete(props.resource.id);
}

const downloadPDF = () => {
    axios({
        url: `/api/resources/${props.resource.id}/downloads`,
        method: 'GET',
        responseType: 'blob'
    }).then((response) => {
        var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');

        fileLink.href = fileUrl;
        fileLink.setAttribute('download', props.resource.file_name);
        document.body.appendChild(fileLink);

        fileLink.click();
    });
}
</script>

<template>
    <div class="card text-bg-pdf">
        <div class="card-header text-end" v-if="$route.name === 'AdminPage'">
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                <router-link :to="{name: 'EditPDF', params: {id: resource.id}}" class="btn btn-outline-dark">Edit</router-link>
                <button type="button" class="btn btn-outline-dark" @click="deletePDF">Delete</button>
            </div>
        </div>

        <div class="card-body">
            <h5 class="card-title">{{ resource.title }}</h5>
            <p class="card-text">
                <a href="javascript:void(0);" @click="downloadPDF">{{ resource.file_name }}</a>
            </p>
        </div>
        <div class="card-footer">
            <small class="text-muted">{{ moment(resource.created_at).fromNow() }}</small>
        </div>
    </div>
</template>
