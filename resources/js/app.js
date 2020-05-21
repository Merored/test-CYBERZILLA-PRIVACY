/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination', JwPagination);



import VueRouter from 'vue-router';
window.Vue.use(VueRouter);

import TasksCreate from './components/tasks/TasksCreate.vue';
import TasksEdit from './components/tasks/TasksEdit.vue';

import UsersList from './components/users/UsersList.vue';
import UsersCreate from './components/users/UsersCreate.vue';
import UsersEdit from './components/users/UsersEdit.vue';

const routes = [
    {
        path: '/',
        component: UsersList, 
        name: 'usersList',
    },
    {
        path: '/users/create',
        component: UsersCreate, 
        name: 'usersCreate',
    },
    {
        path: '/users/:id/edit/',
        component: UsersEdit, 
        name: 'usersEdit',
    },

    {
        path: '/users/:user_id/tasks/create',
        component: TasksCreate, 
        name: 'tasksCreate',
    },
    {
        path: '/users/:user_id/tasks/edit/:id',
        component: TasksEdit, 
        name: 'tasksEdit',
    },
]

const router = new VueRouter({ routes })


const app = new Vue({ router }).$mount('#app')
