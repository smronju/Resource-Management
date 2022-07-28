<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from 'vue-router';
import LinkComponent from './link.vue';
import SnippetComponent from './snippet.vue';
import PDFComponent from './pdf.vue';

const childLinkComponent = ref(null);
const childSnippetComponent = ref(null);
const childPDFComponent = ref(null);
const Router = useRouter();
let resources = ref([]);

onMounted(async () => {
    getResources();
});

const getResources = async () => {
    let response = await axios.get('/api/resources')
    resources.value = response.data.resources;
}

const newResource = () => {
    Router.push('/resource/new');
}
</script>

<template>
    <div class="mt-4">
        <h2 class="text-center">Resource List</h2>

        <div class="row row-cols-3 row-cols-md-3 g-4" v-if="resources.length > 0">
            <div class="col" v-for="resource in resources" :key="resource.id">
                <div v-if="resource.type === 'link'">
                    <LinkComponent ref="childLinkComponent" :resource="resource" />
                </div>

                <div v-else-if="resource.type === 'snippet'">
                    <SnippetComponent ref="childSnippetComponent" :resource="resource" />
                </div>

                <div v-else-if="resource.type === 'pdf'">
                    <PDFComponent ref="childPDFComponent" :resource="resource" />
                </div>
            </div>
        </div>

        <div class="row row-cols-12 row-cols-md-12 g-4" v-else>
            <div class="col">
                <div class="alert alert-info text-center" role="alert">
                    No resource found!
                </div>
            </div>
        </div>
    </div>
</template>
