<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "../Components/TextInput.vue";
import { route } from "../../../../vendor/tightenco/ziggy/src/js";

const form = useForm({
    email: null,
    password: null,
    remember: null,
});

const submit = () => {
    form.post(route("login"), {
        onError: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="| Forgot Password" />
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-[#f3f4f6] w-[350px] rounded-2xl shadow-lg">
            <form @submit.prevent="submit" class="flex flex-col px-8 py-10">
                <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

                <TextInput
                    name="email"
                    type="email"
                    v-model="form.email"
                    :message="form.errors.email"
                />
                <TextInput
                    name="password"
                    type="password"
                    v-model="form.password"
                    :message="form.errors.password"
                />

                <!-- Remember Me and Forgot Password -->
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            v-model="form.remember"
                            id="remember"
                            class="form-checkbox h-3 w-3 text-[#111827]"
                        />
                        <label for="remember" class="ml-2 text-xs"
                            >Remember Me</label
                        >
                    </div>
                    <div>
                        <a
                            :href="route('password.request')"
                            class="ml-2 text-xs font-semibold hover:underline"
                            >Forgot Password?</a
                        >
                    </div>
                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    class="bg-[#030712] text-white font-semibold py-2 rounded-lg hover:bg-[#111827] transition duration-300 my-3 w-full"
                    :disabled="form.processing"
                >
                    Login
                </button>
                <hr class="mb-3 mt-2 border-[#37415135]" />

                <!-- Register Link -->
                <p class="text-xs text-center text-[#030712]">
                    Don't have an account?
                    <a
                        :href="route('register')"
                        class="text-[#111827] font-semibold hover:underline"
                        >Register</a
                    >
                </p>
            </form>
        </div>
    </div>
</template>
