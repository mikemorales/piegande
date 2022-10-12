/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler';
import 'bootstrap/dist/css/bootstrap.css'
import category from './components/admin/category.vue';
import brand from './components/admin/brand.vue';
import product from './components/admin/product.vue';
import modelshoe from './components/admin/model_shoe.vue';
import size from './components/admin/size.vue';
import home from './components/App.vue';
import loading from 'vue3-loading-overlay';
import 'vue3-loading-overlay/dist/vue3-loading-overlay.css';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

/*import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);*/

app.component('categoria', category);
app.component('marca', brand);
app.component('producto', product);
app.component('modelozapato', modelshoe);
app.component('tamanos', size);
app.component('loading', loading);
app.component('home', home);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>

 */
//Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
//});

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
