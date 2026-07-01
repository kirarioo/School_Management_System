import { defineStore } from "pinia";
import api from "../api/axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: localStorage.getItem("token") || null,
        role: [],
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
        
        isAdmin: (state) => state.rolees.includes("Admin"),
        isTeacher: (state) => state.rolees.includes("Teacher"),
        isStudent: (state) => state.rolees.includes("Student"),
        isAccountant: (state) => state.rolees.includes("Accountant"),
        isParent: (state) => state.rolees.includes("Parent"),
    },

    actions: {
        async login(credentials) {
            const response = await api.post("/login", credentials);

            this.token = response.data.token;
            this.user = response.data.user;
            this.role = response.data.roles;

            localStorage.setItem("token", this.token);

            return response.data;
        },

        async getUser() {
            const response = await api.get("/user");

            this.user = response.data;
        },

        async logout() {
            await api.post("/logout");

            this.user = null;
            this.token = null;

            localStorage.removeItem("token");
        },
    },
});