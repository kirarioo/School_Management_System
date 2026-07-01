<template>
    <div class="login-container">
        <h2>School System Login</h2>

        <form @submit.prevent="login">
            <input v-model="email" type="email" placeholder="Email" />
            <input v-model="password" type="password" placeholder="Password" />

            <button type="submit">Login</button>
        </form>

        <p v-if="error" style="color:red" >{{ error }}</p>
    </div>
</template>

<script>
import api from "../../api/axios";
import { useAuthStore } from "../../stores/auth";

export default {
    data() {
        return {
            email: "",
            password: "",
            error: "",
        };
    },


    methods: {
        async login() {
            try{

                const auth = useAuthStore();

                const data = await auth.login({
                    email: this.email,
                    password: this.password,
                });

                const role = data.roles[0];

                if (role === "Admin"){
                    this.$router.push("/admin");
                } else if (role === "Teacher") {
                    this.$router.push("/teacher");
                } else if (role === "Student") {
                    this.$router.push("/student");
                } else if (role === "Accountant") {
                    this.$router.push("/finance");
                } else if (role === "Parent") {
                    this.$router.push("/parent");
                } else {
                    this.$router.push("/dashboard");
                }
    
            } catch (err) {
                this.error = "Invalid login credentials";
            }
        },
    },
};

</script>