// resources/js/app.js

import { createApp } from 'vue';
import { createPinia } from 'pinia'
import HeaderComponent from './components/menu/Header.vue';
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/saga-blue/theme.css'; // Choose your preferred theme
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';

import App from './App.vue';
import router from './router';
// Import Tailwind CSS
import '../css/app.css';
import '../css/global.css';


// Create Vue app
const app = createApp(App);
const pinia = createPinia()
app.use(pinia)
app.use(PrimeVue);
// Register the components globally
app.component('header-component', HeaderComponent);

// Use the router
app.use(router);

// Mount the app to the DOM element
app.mount('#app');
