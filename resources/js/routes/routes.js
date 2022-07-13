import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// middleware
import Auth from '../middleware/Auth.js';
import Guest from '../middleware/Guest.js';

import Dashboard from '../layouts/home/index.vue';
// auth
import AuthLogin from '../layouts/auth/login.vue';
// user
import UsersLoad from '../layouts/users/index.vue';
import UsersStore from '../layouts/users/store.vue';
import UsersUpdate from '../layouts/users/update.vue';
// clients
import ClientLoad from '../layouts/clients/index.vue';
import ClientStore from '../layouts/clients/store.vue';
import ClientUpdate from '../layouts/clients/update.vue';
//categories Product
import ProductCategoryLoad from '../layouts/categories/index.vue';
import ProductCategoryStore from '../layouts/categories/store.vue';
import ProductCategoryUpdate from '../layouts/categories/update.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Dashboard,
        meta: { middlewareAuth: true }
    },
    {
        name: 'login',
        path: '/login',
        component: AuthLogin,
        meta: { middlewareAuth: false }
    },
    {
        name: 'usersLoad',
        path: '/users',
        component: UsersLoad,
        meta: { middlewareAuth: true }
    },
    {
        name: 'usersStore',
        path: '/users/store',
        component: UsersStore,
        meta: { middlewareAuth: true }
    },
    {
        name: 'usersUpdate',
        path: '/users/update/:id',
        component: UsersUpdate,
        meta: { middlewareAuth: true }
    },
    {
        name: 'clientLoad',
        path: '/client',
        component: ClientLoad,
        meta: { middlewareAuth: true }
    },
    {
        name: 'clientStore',
        path: '/client/store',
        component: ClientStore,
        meta: { middlewareAuth: true }
    },
    {
        name: 'clientUpdate',
        path: '/client/update/:id',
        component: ClientUpdate,
        meta: { middlewareAuth: true }
    },
    {
        name: 'product-categoriesLoad',
        path: '/product-categories',
        component: ProductCategoryLoad,
        meta: { middlewareAuth: true }
    },
    {
        name: 'product-categoriesStore',
        path: '/product-categories/store',
        component: ProductCategoryStore,
        meta: { middlewareAuth: true }
    },
    {
        name: 'product-categoriesUpdate',
        path: '/categories/update/:id',
        component: ProductCategoryUpdate,
        meta: { middlewareAuth: true }
    },
];


const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.middlewareAuth) ) {
        if (Auth.check()) {
            next();
            return;
        } else {
            router.push('/login');
        }
    }else if (!to.matched.some(record => record.meta.middlewareAuth) ) {
        if (!Auth.check()) {
            next();
            return;
        } else {
          router.push('/');
        }
    }else {
        next();
    }
});

export default router;
