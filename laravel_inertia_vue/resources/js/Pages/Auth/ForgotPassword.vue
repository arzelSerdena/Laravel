<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "../Components/TextInput.vue";

const form = useForm({
    email: null,
});

defineProps({ status: String });

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <Head title="Login" />
    <div class="flex items-center justify-center min-h-screen bg-[#d1d5db]">
        <div class="bg-[#f3f4f6] w-[350px] rounded-2xl shadow-lg">
            <form @submit.prevent="submit" class="flex flex-col px-8 py-10">
                <h2 class="text-2xl font-bold mb-4 text-center">
                    Reset Password
                </h2>
                <p class="text-xs text-justify text-[#030712] mb-4">
                    Let us know your email address and we will email you a
                    password reset link that will allow you to create a new one.
                </p>
                <TextInput
                    name="email"
                    type="email"
                    v-model="form.email"
                    :message="form.errors.email"
                />

                <!-- Login Button -->
                <button
                    type="submit"
                    class="bg-[#030712] text-white font-semibold py-2 rounded-lg hover:bg-[#111827] transition duration-300 mb-3 w-full"
                    :disabled="form.processing"
                >
                    Send Reset Link
                </button>
            </form>
        </div>
    </div>
</template>
