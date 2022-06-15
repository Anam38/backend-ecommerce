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
