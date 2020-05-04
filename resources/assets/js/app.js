import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
Vue.use(VueRouter)
Vue.use(Vuex)
import App from './views/App'
import Home from './views/Home'
import CommentsIndex from "./components/comments/CommentsIndex";
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },

        {
            path: '/post/:id/list',
            name: 'post',
            component: CommentsIndex,
        },
    ],
});


const app = new Vue({
    el: '#app',
    components: { App },
    router,
    Vuex,
});
