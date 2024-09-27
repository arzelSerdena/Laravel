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
    <div class="ml-3">
        <form @submit.prevent="submit" class="flex flex-col">
            <TextInput
                name="email"
                type="email"
                v-model="form.email"
                :message="form.errors.email"
                class="flex gap-24 w-full mb-1"
            />

            <TextInput
                name=" New password"
                type="password"
                v-model="form.password"
                :message="form.errors.password"
                class="flex gap-10 w-full mb-0"
            />
            <div
                class="text-[10px] text-gray-600 pl-5 mb-2 col-start-3 col-span-10 ml-32"
            >
                <ul class="">
                    <li>
                        Minimum 8 characters, including at least 1 uppercase
                        letter, 1 lowercase letter, 1 number, and 1 special
                        character (e.g., !, @, #, $).
                    </li>
                    <li>
                        Avoid common words or sequences like "12345" or
                        "password".
                    </li>
                </ul>
            </div>
            <TextInput
                name="confirm password"
                type="password"
                v-model="form.password_confirmation"
                class="flex gap-5 w-full mb-0"
            />
            <p
                class="text-[10px] text-gray-600 pl-5 mb-2 col-start-3 col-span-10 ml-32"
            >
                Passwords must match.
            </p>

            <button
                class="text-xs border rounded-lg py-1.5 px-3 text-nowrap border-[#030712] bg-[#030712] text-white ease-in duration-100 w-max self-end"
                :disabled="form.processing"
            >
                Change Password
            </button>
        </form>
    </div>
</template>
