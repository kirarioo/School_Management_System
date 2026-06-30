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

                await auth.login({
                    email: this.email,
                    password: this.password,
                });

                this.$router.push("/dashboard");
    
            } catch (err) {
                this.error = "Invalid login credentials";
            }
        },
    },
};

</script>