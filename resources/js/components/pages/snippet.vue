<script setup>
import { ref } from 'vue';
import moment from 'moment';

const props = defineProps(['resource', 'delete']);
defineEmits(['deleteResource']);

const deleteSnippet = () => {
    props.delete(props.resource.id);
}

const copySnippet = async () => {
    try {
        await navigator.clipboard.writeText(props.resource.snippet);

        toast.fire({
            icon: 'success',
            title: 'Snippet copied to clipboard.'
        });
    } catch(error) {
        toast.fire({
            icon: 'error',
            title: 'Could not copy snippet to clipboard.'
        });
    }
}
</script>

<template>
    <div class="card">
        <div class="card-header text-end" v-if="$route.name === 'AdminPage'">
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                <button type="button" class="btn btn-outline-dark" @click="copySnippet">Copy Snippet</button>
                <router-link :to="{name: 'EditSnippet', params: {id: resource.id}}" class="btn btn-outline-dark">Edit</router-link>
                <button type="button" class="btn btn-outline-dark" @click="deleteSnippet(resource.id)">Delete</button>
            </div>
        </div>

        <div class="card-body">
            <div class="text-end" v-if="$route.name === 'HomePage'">
                <button type="button" class="btn btn-outline-dark" @click="copySnippet">Copy Snippet</button>
            </div>

            <h5 class="card-title">{{ resource.title }}</h5>
            <p class="card-text">{{ resource.description }}</p>
            <code>{{ resource.snippet }}</code>
        </div>
        <div class="card-footer">
            <small class="text-muted">{{ moment(resource.created_at).fromNow() }}</small>
        </div>
    </div>
</template>
