import Vue from 'vue';
import VueRouter from 'vue-router';
import index from './pages/index.vue';
import customers from './pages/customers.vue';

Vue.use(VueRouter);
const router = new VueRouter({
mode: 'history',
linkExactActiveClass: 'active',
routes: [
    {
        path: '/',
        name: 'home',
        component: index
    },
    {
        path: '/customers',
        name: 'customers',
        component: customers
    },
]
});
export default router;
