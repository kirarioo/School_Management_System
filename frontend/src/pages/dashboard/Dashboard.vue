<template>

    <div>
        <h1>Dashboard</h1>

        <p>Welcome to School Management System</p>

        <button @click="logout">Logout</button>
    </div>
</template>

<script>
import api from "../../api/axios";

export default {
    methods: {
        async logout() {
            try {
                await api.post("/logout");

                localStorage.removeItem("token");

                this.$router.push("/login");
            } catch (err) {
                console.log(err);
            }
        },
    },
};

</script>