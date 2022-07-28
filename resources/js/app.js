import './bootstrap';
import '../sass/app.scss';
import Swal from 'sweetalert2/dist/sweetalert2';
import 'sweetalert2/dist/sweetalert2.css';

window.Swal = Swal;

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
});

window.toast = toast;

import { createApp } from 'vue';
import Layout from './components/layouts/master.vue';
import Router from './components/router';

createApp(Layout).use(Router).mount('#root');
