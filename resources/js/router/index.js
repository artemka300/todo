import { createRouter, createWebHistory } from 'vue-router'
import Home from './routers/Home.vue'
import Plan from './routers/Home/Plan.vue'
import Task from './routers/Home/Tasks.vue'
import Login from './routers/Login.vue'
import Reg from './routers/Reg.vue'
import { authFetch } from '../api'
const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: {
            name: 'home'
        },
        children: [
            {
                path: '',
                name: 'Plan',
                component: Plan,
                meta: {
                    name: 'home'
                },
            },

            {
                path: 'task/:id',
                name: 'Task',
                component: Task,
                meta: {
                    name: 'home'
                },
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
router.beforeEach(async (to, from) => {
    if (to.meta.name == 'home') {
        return await authFetch('/api/authcheck').then(r => {
            if (r.status == 200) {
            } else {
                return '/login'
            }
        })
    }
    if (to.fullPath == '/login' || to.fullPath == '/reg') {
        return await authFetch('/api/authcheck').then(r => {
            if (r.status == 200) {
                return '/'
            }
        })
    }
})

export default router
