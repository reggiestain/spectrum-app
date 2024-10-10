// resources/js/app.js

import { createApp } from 'vue';
import { createPinia } from 'pinia'
import HeaderComponent from './components/menu/Header.vue';

import App from './App.vue';
import router from './router';
// Import Tailwind CSS
import '../css/app.css';
import '../css/global.css';


// Create Vue app
const app = createApp(App);
const pinia = createPinia()
app.use(pinia)

// Register the components globally
app.component('header-component', HeaderComponent);

// Use the router
app.use(router);

// Mount the app to the DOM element
app.mount('#app');
