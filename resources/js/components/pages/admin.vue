<script setup>
import { onMounted, ref } from "vue";
import { useRouter } from 'vue-router';
import LinkComponent from './link.vue';
import SnippetComponent from './snippet.vue';
import PDFComponent from './pdf.vue';
import axios from "axios";

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

const newLink = () => {
    Router.push('/admin/new/link');
}

const newSnippet = () => {
    Router.push('/admin/new/snippet');
}

const newPDF = () => {
    Router.push('/admin/new/pdf');
}

const deleteResource = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/api/resources/${id}`)
                .then(response => {
                    if (response.status === 200) {
                        let deletedResource = resources.value.map(item => item.id).indexOf(id);
                        resources.value.splice(deletedResource, 1);

                        Swal.fire(
                            'Deleted!',
                            'Your resource has been deleted.',
                            'success'
                        )
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    });
}

</script>

<template>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="mt-2">
                    <button type="button" class="btn btn-primary btn-sm float-end" @click="newPDF">Upload PDF</button>
                    <button type="button" class="btn btn-primary btn-sm float-end me-1" @click="newSnippet">Create HTML Snippet</button>
                    <button type="button" class="btn btn-primary btn-sm float-end me-1" @click="newLink">Add a Link</button>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <div class="row row-cols-3 row-cols-md-3 g-4" v-if="resources.length > 0">
                        <div class="col" v-for="resource in resources" :key="resource.id">
                            <div v-if="resource.type === 'link'">
                                <LinkComponent ref="childLinkComponent" :resource="resource" :delete="deleteResource" />
                            </div>

                            <div v-else-if="resource.type === 'snippet'">
                                <SnippetComponent ref="childSnippetComponent" :resource="resource" :delete="deleteResource" />
                            </div>

                            <div v-else-if="resource.type === 'pdf'">
                                <PDFComponent ref="childPDFComponent" :resource="resource" :delete="deleteResource" />
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
            </div>
        </div>
    </div>
</template>
