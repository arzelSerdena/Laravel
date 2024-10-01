<script setup>
import { ref, watch } from "vue";
import PaginationLinks from "./Components/PaginationLinks.vue";
import { router, useForm } from "@inertiajs/vue3";
import { debounce } from "lodash";

const props = defineProps({
    users: Object,
    searchTerm: String,
    can: Object,
});

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    avatar: null,
    preview: null,
    is_admin: null,
});

const search = ref(props.searchTerm);

watch(
    search,
    debounce(
        (q) => router.get("/", { search: q }, { preserveState: true }),
        500
    )
);

const getDate = (date) =>
    new Date(date).toLocaleDateString("en-us", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });

const submit = (userId) => {
    form.delete(route("user.destroy", userId));
};

const editUser = (userId) => {
    router.visit(route("user.edit", userId));
};
</script>

<template>
    <Head :title="` | ${$page.component}`" />

    <div class="pt-10 min-h-screen">
        <div class="flex justify-end mb-4">
            <div class="w-1/4">
                <input type="search" placeholder="Search" v-model="search" />
            </div>
        </div>

        <table>
            <thead>
                <tr class="bg-slate-300">
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                    <th v-if="$page.props.auth.user.is_admin">Role</th>
                    <th v-if="$page.props.auth.user.is_admin">Edit</th>
                    <th v-if="$page.props.auth.user.is_admin">Delete</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <td>
                        <img
                            :src="
                                user.avatar
                                    ? 'storage/' + user.avatar
                                    : 'storage/avatars/default.jpg'
                            "
                            class="avatar"
                        />
                    </td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td class="text-nowrap">{{ getDate(user.created_at) }}</td>
                    <td v-if="$page.props.auth.user.is_admin">
                        {{ user.is_admin ? "Admin" : "User" }}
                    </td>
                    <td v-if="$page.props.auth.user.is_admin">
                        <button
                            @click="editUser(user.id)"
                            :disabled="form.processing"
                        >
                            Edit
                        </button>
                    </td>
                    <td v-if="$page.props.auth.user.is_admin">
                        <form @submit.prevent="submit(user.id)">
                            <button :disabled="form.processing">Delete</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        <!---pagination links-->
        <div>
            <PaginationLinks :paginator="users" />
        </div>
    </div>
</template>
