import { createRouter, createWebHistory } from 'vue-router'
import Home from './routers/Home.vue'
import Plan from './routers/Home/Plan.vue'
import Task from './routers/Home/Tasks.vue'
import Login from './routers/Login.vue'
import Reg from './routers/Reg.vue'
const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        children: [
            {
                path: '',
                name: 'Plan',
                component: Plan
            },

            {
                path: 'task/:id',
                name: 'Task',
                component: Task
            }
        ]
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/reg',
        name: 'Reg',
        component: Reg
    },
]
const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
