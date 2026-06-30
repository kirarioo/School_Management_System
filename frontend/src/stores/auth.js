import { defineStore } from "pinia";
import api from "../api/axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: localStorage.getItem("token") || null,
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
    },

    actions: {
        async login(credentials) {
            const response = await api.post("/login", credentials);

            this.token = response.data.token;
            this.user = response.data.user;

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