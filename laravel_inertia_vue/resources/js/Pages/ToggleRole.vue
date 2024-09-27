<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    user: Object, // assuming single user prop passed in
});

const form = useForm();

const toggleRole = () => {
    form.patch(route("user.toggleRole", props.user.id));
};
</script>

<template>
    <form @submit.prevent="toggleRole">
        <button
            class="text-xs border rounded-lg py-1.5 px-3 text-nowrap mb-3"
            :class="
                props.user.is_admin
                    ? 'bg-red-500 text-white'
                    : 'bg-green-500 text-white'
            "
            :disabled="form.processing"
        >
            {{ props.user.is_admin ? "Revoke Admin Access" : "Make Admin" }}
        </button>
    </form>
</template>
