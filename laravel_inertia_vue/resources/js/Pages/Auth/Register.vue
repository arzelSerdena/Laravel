<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "../Components/TextInput.vue";

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    admin_token: null,
    avatar: null,
    preview: null,
});

const change = (e) => {
    form.avatar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
};

const submit = () => {
    form.post(route("register"), {
        onError: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="| Register" />
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-[#f3f4f6] w-[350px] rounded-2xl shadow-lg">
            <form @submit.prevent="submit" class="flex flex-col px-8 py-10">
                <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

                <!-- avatar -->
                <div class="grid place-items-center">
                    <div
                        class="relative w-20 h-20 rounded-full overflow-hidden border border-slate-300 self-center"
                    >
                        <label
                            for="avatar"
                            class="absolute inset-0 grid content-end cursor-pointer"
                        >
                            <span
                                class="bg-white/50 pb-2 pt-0.5 flex justify-center translate-y-1"
                                ><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="14"
                                    height="14"
                                    fill="#03071277"
                                    class="bi bi-camera-fill text-center"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"
                                    />
                                    <path
                                        d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0"
                                    /></svg
                            ></span>
                        </label>
                        <input type="file" @input="change" id="avatar" hidden />

                        <img
                            class="rounded-full w-20 h-20 object-cover"
                            :src="form.preview ?? 'storage/avatars/default.png'"
                        />
                    </div>

                    <p class="error mt-2">{{ form.errors.avatar }}</p>
                </div>

                <TextInput
                    name="name"
                    v-model="form.name"
                    :message="form.errors.name"
                />
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
                <TextInput
                    name="confirm password"
                    type="password"
                    v-model="form.password_confirmation"
                />

                <TextInput
                    name="Admin Token"
                    v-model="form.admin_token"
                    :message="form.errors.admin_token"
                />

                <button
                    class="bg-[#030712] text-white font-semibold py-2 rounded-lg hover:bg-[#111827] transition duration-300 mb-3 mt-1 w-full"
                    :disabled="form.processing"
                >
                    Register
                </button>
                <hr class="mb-3 mt-2 border-[#37415135]" />

                <!-- Login Link -->
                <p class="text-xs text-center text-[#030712]">
                    Already have an account?
                    <a
                        :href="route('login')"
                        class="text-[#111827] font-semibold hover:underline"
                        >Login</a
                    >
                </p>
            </form>
        </div>
    </div>
</template>
