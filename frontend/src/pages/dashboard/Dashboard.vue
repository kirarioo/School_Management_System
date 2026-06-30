<template>

    <div>
        <h1>Dashboard</h1>

        <p>Welcome to School Management System</p>

        <button @click="logout">Logout</button>
    </div>
</template>

<script>
import api from "../../api/axios";
import { useAuthStore } from "../../stores/auth";

export default {
    methods: {
        async logout() {

            const auth = useAuthStore();
            
            await auth.logout();
            
            this.$router.push("/login");
        },
    },
};

</script>