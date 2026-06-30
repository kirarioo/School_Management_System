import { createRouter, createWebHistory } from "vue-router";

import Login from "../pages/auth/Login.vue";
import Dashboard from "../pages/dashboard/Dashboard.vue";

const routes = [
    {
        path: "/",
        redirect: "/login",
    },
    {
        path: "/login",
        component: Login,
    },
    {
        path: "/dashboard",
        component: Dashboard,
        meta: { requireAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token");

    if (to.meta.requireAuth && !token) {
        next("/login");
    } else {
        next();
    }
});

export default router;