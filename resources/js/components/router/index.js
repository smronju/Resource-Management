import { createRouter, createWebHistory } from "vue-router";
import homePage from '../pages/home.vue';
import adminPage from '../pages/admin.vue';
import newLink from '../pages/linkForm.vue';
import newSnippet from '../pages/snippetForm.vue';
import newPDF from '../pages/pdfForm.vue';
import editLink from '../pages/editLink.vue';
import editSnippet from '../pages/editSnippet.vue';
import editPDF from '../pages/editPDF.vue';
import notFound from '../NotFound.vue';

const Routes = [
    {
        name: 'HomePage',
        path: '/',
        component: homePage
    },
    {
        name: 'AdminPage',
        path: '/admin',
        component: adminPage
    },
    {
        name: 'NewLink',
        path: '/admin/new/link',
        component: newLink
    },
    {
        name: 'NewSnippet',
        path: '/admin/new/snippet',
        component: newSnippet
    },
    {
        name: 'NewPDF',
        path: '/admin/new/pdf',
        component: newPDF
    },
    {
        name: 'EditLink',
        path: '/admin/link/edit/:id',
        component: editLink
    },
    {
        name: 'EditSnippet',
        path: '/admin/snippet/edit/:id',
        component: editSnippet
    },
    {
        name: 'EditPDF',
        path: '/admin/pdf/edit/:id',
        component: editPDF
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
];

const Router = createRouter({
    history: createWebHistory(),
    routes: Routes
});

export default Router;
