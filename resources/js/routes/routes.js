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
//categories master Product
import ProductCategoryLoad from '../layouts/category_product/index.vue';
import ProductCategoryStore from '../layouts/category_product/store.vue';
//categories child Product
import ProductCategoryChildLoad from '../layouts/category_child_product/index.vue';
import ProductCategoryChlidStore from '../layouts/category_child_product/store.vue';
// Product
import ProductLoad from '../layouts/products/index.vue';
import ProductStore from '../layouts/products/store.vue';
import ProductUpdate from '../layouts/products/update.vue';
// integration
import FrontendIntegration from '../layouts/integration/frontend.vue';
import BackendIntegration from '../layouts/integration/backend.vue';

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
        name: 'product-child-categoriesLoad',
        path: '/product-child-categories',
        component: ProductCategoryChildLoad,
        meta: { middlewareAuth: true }
    },
    {
        name: 'product-child-categoriesStore',
        path: '/product-child-categories/store',
        component: ProductCategoryChlidStore,
        meta: { middlewareAuth: true }
    },
    {
        name: 'productLoad',
        path: '/products',
        component: ProductLoad,
        meta: { middlewareAuth: true }
    },
    {
        name: 'productStore',
        path: '/products/store',
        component: ProductStore,
        meta: { middlewareAuth: true }
    },
    {
        name: 'productUpdate',
        path: '/products/update/:id',
        component: ProductUpdate,
        meta: { middlewareAuth: true }
    },
    {
      name: 'frontendLoad',
      path: '/integration/frontend',
      component: FrontendIntegration,
      meta: { middlewareAuth: true }
    },
    {
      name: 'bacnkendLoad',
      path: '/integration/backend',
      component: BackendIntegration,
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
