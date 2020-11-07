/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueToastr2 from 'vue-toastr-2'
import 'vue-toastr-2/dist/vue-toastr-2.min.css'
import * as VeeValidate from 'vee-validate';
import 'vue-search-select/dist/VueSearchSelect.css'
import DataTable from 'laravel-vue-datatable';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import VueGeolocation from 'vue-browser-geolocation';
Vue.use(VueGeolocation);
import * as VueGoogleMaps from 'vue2-google-maps'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import wysiwyg from "vue-wysiwyg";
Vue.use(wysiwyg, {
    hideModules: { "code": true },
    

}); // config is optional. more below
Vue.component('pagination', require('laravel-vue-pagination'))
import StarRating from 'vue-star-rating'

Vue.component('star-rating', StarRating);
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css'
 
Vue.component('datetime', Datetime);

 import "vue-wysiwyg/dist/vueWysiwyg.css";



// Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');

Vue.component("Loading", Loading)
Vue.use(VueGoogleMaps, {
    load: {  
      key: 'AIzaSyCD3BT0gWnJoOI9U9UOHz3XRwnc9r7jxXc',
      libraries: 'places', // This is required if you use the Autocomplete plugin
      // OR: libraries: 'places,drawing'
      // OR: libraries: 'places,drawing,visualization'
      // (as you require)
   
      //// If you want to set the version, you can do so:
      // v: '3.26',
    },
});






Vue.use(DataTable);

// Vue.use(VeeValidate);

Vue.use(VeeValidate, {
    classes:true,
     classNames: {
    valid: "is-valid",
    invalid: "is-invalid"
  }
    
  });

window.toastr = require('toastr')
 
Vue.use(VueToastr2)

// Vue.use(VeeValidate);

import {
    Form,
    HasError,
    AlertError,
    AlertErrors
  
} from 'vform'


import objectToFormData from "./objectToFormData";
 window.objectToFormData = objectToFormData
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//Compomemts
Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Routes from './route.js';
window.Form = Form;
const el = document.body;

const app = new Vue({
    data: { mainLoading: false },

    el: '#app',
        router: Routes,
        
});
axios.interceptors.request.use(config => {
    // console.log(el.classList);
    el.classList.add('pointer-off');
    app.mainLoading = true;

    return config;
});


axios.interceptors.response.use(config => {

    el.classList.remove('pointer-off');

    app.mainLoading = false;

    return config;
}, error => {

     el.classList.remove('pointer-off');
     app.mainLoading = false;

    return Promise.reject(error);
});
