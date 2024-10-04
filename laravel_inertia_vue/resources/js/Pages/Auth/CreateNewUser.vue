<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "../Components/TextInput.vue";

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.post(route("user.createNewUser"), {
        onError: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="| Create a New User" />
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-[#f3f4f6] w-[350px] rounded-2xl shadow-lg">
            <form @submit.prevent="submit" class="flex flex-col px-8 py-10">
                <h2 class="text-2xl font-bold mb-6 text-center">
                    Create a New User
                </h2>

                <TextInput
                    name="name"
                    v-model="form.name"
                    :message="form.errors.name"
                    class="mb-4"
                />
                <TextInput
                    name="email"
                    type="email"
                    v-model="form.email"
                    :message="form.errors.email"
                    class="mb-4"
                />
                <TextInput
                    name="password"
                    type="password"
                    v-model="form.password"
                    :message="form.errors.password"
                    class="mb-4"
                />
                <TextInput
                    name="confirm password"
                    type="password"
                    v-model="form.password_confirmation"
                    class="mb-4"
                />

                <button
                    class="bg-[#030712] text-white font-semibold py-2 rounded-lg hover:bg-[#111827] transition duration-300 mb-3 mt-1 w-full"
                    :disabled="form.processing"
                >
                    Create User
                </button>
                <hr class="mb-3 mt-2 border-[#37415135]" />
            </form>
        </div>
    </div>
</template>
