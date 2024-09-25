<script setup>
import { ref, watch } from "vue";
import PaginationLinks from "./Components/PaginationLinks.vue";
import { router } from "@inertiajs/vue3";
import { debounce } from "lodash";
import { useForm } from "@inertiajs/vue3";

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
    // Redirect to the user settings page with user ID
    router.visit(route("user.edit", userId));
};
</script>

<template>
    <Head :title="` | ${$page.component}`" />

    <div class="pt-10">
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
                    <th v-if="can.delete_user">Edit</th>
                    <th v-if="can.delete_user">Delete</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <td>
                        <img
                            :src="
                                user.avatar
                                    ? 'storage/' + user.avatar
                                    : 'storage/avatars/default.png'
                            "
                            class="avatar"
                        />
                    </td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ getDate(user.created_at) }}</td>
                    <td v-if="can.delete_user">
                        <!-- Use a link or button to navigate to the edit page -->
                        <button
                            @click="editUser(user.id)"
                            :disabled="form.processing"
                            class=""
                        >
                            Edit
                        </button>
                    </td>
                    <td v-if="can.delete_user">
                        <form @submit.prevent="submit(user.id)">
                            <button :disabled="form.processing" class="">
                                Delete
                            </button>
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
