
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// Require Froala Editor js file.
require('froala-editor/js/froala_editor.pkgd.min')

// Require Froala Editor css files.
require('froala-editor/css/froala_editor.pkgd.min.css')
require('font-awesome/css/font-awesome.css')
require('froala-editor/css/froala_style.min.css')

window.Vue = require('vue');

import article from './components/ArticleComponent.vue'
import edition from './components/EditComponent.vue'
import VueFroala from 'vue-froala-wysiwyg'
import VueRouter from 'vue-router'
import Vuemoment from 'vue-moment'
Vue.use(Vuemoment)
Vue.use(VueRouter)
Vue.use(VueFroala)

const routes = [
    {
        path: '/post/:id',
        component: article,
        name:'article'
    },
    {
        path: '/post/edit/:id',
        component: edition,
        name:'edition'
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('form-component', require('./components/FormComponent.vue'));
Vue.component('acceuil-component', require('./components/AcceuilComponent.vue'));

const app = new Vue({
    el: '#Vueapp',
    router
});
