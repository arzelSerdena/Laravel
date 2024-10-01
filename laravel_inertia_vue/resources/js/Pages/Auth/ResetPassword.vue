<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "../Components/TextInput.vue";
const props = defineProps({
    token: String,
    email: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.post(route("password.update"), {
        onError: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="| Reset Password" />
    <div class="flex items-center justify-center min-h-screen bg-[#d1d5db]">
        <div class="bg-[#f3f4f6] w-[350px] rounded-2xl shadow-lg">
            <form @submit.prevent="submit" class="flex flex-col px-8 py-10">
                <h2 class="text-2xl font-bold mb-6 text-center">
                    Create your new password
                </h2>

                <TextInput
                    name="email"
                    type="email"
                    v-model="form.email"
                    :message="form.errors.email"
                    class="mb-5"
                />

                <TextInput
                    name=" New password"
                    type="password"
                    v-model="form.password"
                    :message="form.errors.password"
                    class="mb-5"
                />
                <TextInput
                    name="confirm password"
                    type="password"
                    v-model="form.password_confirmation"
                    class="mb-5"
                />

                <button
                    class="bg-[#030712] text-white font-semibold py-2 rounded-lg hover:bg-[#111827] transition duration-300 mb-3 mt-1 w-full"
                    :disabled="form.processing"
                >
                    Reset Password
                </button>
                <hr class="mb-3 mt-2 border-[#37415135]" />
            </form>
        </div>
    </div>
</template>
