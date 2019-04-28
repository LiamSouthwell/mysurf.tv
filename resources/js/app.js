
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueRouter from 'vue-router';

import watchvideo from './components/Watchvideo.vue';
import videolist from './components/Videolist.vue';
import navbar from './components/Navbar.vue';
import carousel from './components/Carousel.vue';


window.Vue = require('vue');
Vue.use(VueRouter);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('loader', require('./components/Loader.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('videolist', require('./components/Videolist.vue').default);
Vue.component('watchvideo', require('./components/Watchvideo.vue').default);
Vue.component('carousel', require('./components/Carousel.vue').default);
Vue.component('thumbnail', require('./components/Thumbnail.vue').default);




const routes = [
    { 
	    path: '/search/:terms', 
		components:{default: videolist},
		props: true	  
	},
	{
		path: '/view', 
		components: {default: watchvideo}	  
	},
    {
    	path: '/', 
		components: {default: carousel, viewport: videolist}	  
    },
]
 

const router = new VueRouter({
  routes // short for `routes: routes`
})


const app = new Vue({
    el: '#app',
    router,
});
