import { createRouter, createWebHistory } from "vue-router";

import Login from "../pages/auth/Login.vue";
import Dashboard from "../pages/dashboard/Dashboard.vue";
import AdminDashboard from "../pages/admin/Dashboard.vue";
import TeacherDashboard from "../pages/teacher/Dashboard.vue";
import StudentDashboard from "../pages/student/Dashboard.vue";
import FinanceDashboard from "../pages/finance/Dashboard.vue";
import ParentDashboard from "../pages/parent/Dashboard.vue";

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
    {
        path: "/admin",
        component: AdminDashboard,
        meta: { requireAuth: true },
    },
    {
        path: "/teacher",
        component: TeacherDashboard,
        meta: { requireAuth: true },
    },
    {
        path: "/student",
        component: StudentDashboard,
        meta: { requireAuth: true },
    },
    {
        path: "/finance",
        component: FinanceDashboard,
        meta: { requireAuth: true },
    },
    {
        path: "/parent",
        component: ParentDashboard,
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