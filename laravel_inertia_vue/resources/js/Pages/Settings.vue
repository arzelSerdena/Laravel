<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "./Components/TextInput.vue";
import SettingsResetPassword from "./Auth/SettingsResetPassword.vue";
import { route } from "../../../vendor/tightenco/ziggy/src/js";
import AvatarChange from "./Auth/AvatarChange.vue";

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    avatar: null,
    preview: null,
});

const props = defineProps({
    users: Object,
});

const submit = () => {
    form.delete(route("profile.destroy"));
};
</script>

<template>
    <Head title="| Settings" />

    <div class="p-10 max-w-[1200px] m-auto min-h-screen">
        <div
            class="grid grid-cols-12 rounded-2xl p-5 h-full bg-[#f3f4f6] shadow-lg"
        >
            <!-- Navigation -->
            <div class="col-span-2 flex flex-col gap-2">
                <a href="#editProfile" class="text-sm font-medium"
                    >Edit Profile</a
                >
                <a href="#updateAvatar" class="text-xs font-medium pl-5"
                    >Update Avatar</a
                >
                <a href="updateName" class="text-xs font-medium pl-5"
                    >Update Name</a
                >

                <a href="#privacyAndSecurity" class="text-sm font-medium"
                    >Privacy & Security</a
                >
                <a href="#changePassword" class="text-xs font-medium pl-5"
                    >Change Password</a
                >
                <a href="#changeEmail" class="text-xs font-medium pl-5"
                    >Change Email</a
                >
                <a
                    href="#deleteAccount"
                    class="text-sm font-medium text-red-700"
                    >Delete Account</a
                >
            </div>

            <!-- Edit Profile -->
            <div class="border-l-2 col-span-10 pl-5 h-full">
                <form
                    @submit.prevent="form.patch(route('settings_name.update'))"
                >
                    <div id="editProfile">
                        <h3 class="font-semibold">Edit Profile</h3>

                        <!-- Update Avatar -->
                        <AvatarChange id="updateAvatar" />

                        <!-- Update Name -->
                        <div class="flex pl-3 items-center gap-5 mb-5">
                            <TextInput
                                name="name"
                                v-model="form.name"
                                :message="form.errors.name"
                                :placeholder="$page.props.auth.user.name"
                                class="flex gap-5 w-full mb-0"
                                id="updateName"
                            />
                            <button
                                class="text-xs border rounded-lg py-1.5 px-3 text-nowrap border-[#030712] bg-[#030712] text-white ease-in duration-100"
                                :disabled="form.processing"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Privacy and Security -->
                <div id="privacyAndSecurity" class="mb-5">
                    <h3 class="font-semibold">Privacy & Security</h3>

                    <!-- Change Password -->
                    <h6 id="changePassword" class="text-sm font-medium">
                        Change Password
                    </h6>
                    <SettingsResetPassword />

                    <!-- Change Email -->
                    <h6 id="changeEmail" class="text-sm font-medium">
                        Change Email
                    </h6>
                    <form
                        @submit.prevent="
                            form.patch(route('settings_email.update'))
                        "
                        class="flex flex-col"
                    >
                        <div class="flex pl-3 items-center gap-5 mb-3">
                            <TextInput
                                name=" New email"
                                type="email"
                                v-model="form.email"
                                :placeholder="$page.props.auth.user.email"
                                :message="form.errors.email"
                                class="flex gap-5 w-full mb-0"
                            />
                        </div>
                        <button
                            class="text-xs border rounded-lg py-1.5 px-3 text-nowrap border-[#030712] bg-[#030712] text-white ease-in duration-100 w-max self-end"
                            :disabled="form.processing"
                        >
                            Change Email
                        </button>
                    </form>
                </div>

                <!-- Delete Account -->
                <form @submit.prevent="submit">
                    <div id="deleteAccount">
                        <h3 class="text-red-700 font-semibold">
                            Delete Account
                        </h3>
                        <p class="text-[10px] mb-2 text-justify">
                            Deleting your account is permanent and cannot be
                            undone. All your data, including profile
                            information, settings, and content, will be
                            permanently removed. You will lose access to your
                            account and any associated services. Please ensure
                            you have downloaded any important data before
                            proceeding.
                        </p>
                        <button
                            class="text-xs border rounded-lg py-1.5 px-3 text-nowrap mb-3 border-red-700 bg-red-700 text-white ease-in duration-100"
                            :disabled="form.processing"
                        >
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
