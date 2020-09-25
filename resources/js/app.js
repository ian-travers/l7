/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Vue.prototype.authorize = function(handler) {
    let user = window.App.user;

    return user ? handler(user) : false;
};

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('select-country', require('./components/SelectCountry').default);
Vue.component('flash', require('./components/Flash').default);
Vue.component('avatar-form', require('./components/AvatarForm').default);
Vue.component('without-avatar-form', require('./components/WithoutAvatarForm').default);
Vue.component('image-upload', require('./components/ImageUpload').default);
Vue.component('comments', require('./components/Comments').default);
Vue.component('all-news', require('./components/AllNews').default);
Vue.component('news', require('./components/News').default);
Vue.component('posts', require('./components/Posts').default);
Vue.component('post', require('./components/Post').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
