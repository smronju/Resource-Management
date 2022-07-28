<script setup>
import moment from 'moment';
import { useRouter } from 'vue-router'
import axios from "axios";

const props = defineProps(['resource', 'delete']);
const Router = useRouter();
defineEmits(['deleteResource']);

const deleteLink = () => {
    props.delete(props.resource.id);
}
</script>

<template>
    <div class="card text-bg-link">
        <div class="card-header text-end" v-if="$route.name === 'AdminPage'">
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                <router-link :to="{name: 'EditLink', params: {id: resource.id}}" class="btn btn-outline-dark">Edit</router-link>
                <button type="button" class="btn btn-outline-dark" @click="deleteLink">Delete</button>
            </div>
        </div>

        <div class="card-body">
            <h5 class="card-title">{{ resource.title }}</h5>
            <p class="card-text">
                <a :href="resource.link" :target="resource.new_tab == 1 ? '_blank' : ''">{{ resource.link }}</a>
            </p>
        </div>
        <div class="card-footer">
            <small class="text-muted">{{ moment(resource.created_at).fromNow() }}</small>
        </div>
    </div>
</template>
