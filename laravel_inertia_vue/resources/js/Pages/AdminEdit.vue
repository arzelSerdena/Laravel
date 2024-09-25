<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "./Components/TextInput.vue";
import UpdateProfile from "./UpdateProfile.vue";

const props = defineProps(["user"]); // Receiving user as a prop

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    avatar: null,
    preview: null,
});

const change = (e) => {
    form.avatar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
};

// const submit = () => {
//     console.log(form); // Log form data for debugging
//     form.patch(route("user.update", { user: props.user.id }), {
//         onError: () => form.reset("password", "password_confirmation"),
//     });
// };

const submit = (userId) => {
    form.patch(route("user.update", userId));
};
</script>

<template>
    <Head title="| Settings" />

    <div class="p-10 max-w-[1200px] m-auto">
        <div class="grid grid-cols-12 border-2 rounded-2xl p-5 h-full">
            <div class="col-span-2 flex flex-col gap-2">
                <a href="" class="text-sm font-medium">Edit Profile</a>
                <a href="" class="text-xs font-medium pl-5">Update Avatar</a>

                <a href="" class="text-xs font-medium pl-5">Update Name</a>
                <a href="" class="text-xs font-medium pl-5">Update Bio</a>
                <a href="" class="text-sm font-medium">Privacy & Security</a>
                <a href="" class="text-xs font-medium pl-5">Change Password</a>
                <a href="" class="text-xs font-medium pl-5">Change Email</a>
            </div>
            <div class="border-l-2 col-span-10 pl-5 h-full">
                <form @submit.prevent="submit(user.id)">
                    <div id="editProfile">
                        <h3 class="font-semibold">Edit Profile</h3>

                        <div class="flex pl-3 items-center gap-5 my-4">
                            <input
                                type="file"
                                @input="change"
                                id="avatar"
                                hidden
                            />

                            <img
                                class="rounded-full w-20 h-20 object-cover"
                                :src="
                                    form.preview ??
                                    'storage/avatars/default.png'
                                "
                            />
                            <div class="">
                                <label
                                    for="avatar"
                                    class="cursor-pointer text-xs border border-[#03071288] rounded-lg py-1 px-3 mb-3 hover:border-[#030712] hover:bg-[#030712] hover:text-white ease-in duration-100 w-max"
                                >
                                    Update Avatar
                                </label>
                                <div
                                    class="text-[10px] text-gray-600 flex flex-col gap-[1px]"
                                >
                                    <p>File size limit: 2MB.</p>
                                    <p>Supported file formats: JPG, PNG.</p>
                                    <p>
                                        For best results, use a square image
                                        (recommended size: 512x512px).
                                    </p>
                                    <p>{{ form.errors.avatar }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex pl-3">
                            <TextInput
                                name="name"
                                v-model="form.name"
                                :message="form.errors.name"
                                :placeholder="$page.props.user.name"
                                class="flex gap-5 w-full"
                            />
                        </div>

                        <!-- <div class="flex pl-3">
                            <label for="" class="mr-8 text-sm font-medium"
                                >Bio</label
                            >
                            <div class="w-full">
                                <textarea
                                    name=""
                                    id=""
                                    cols="10"
                                    rows="5"
                                    placeholder="Use this space to tell others about yourself, your interests, or expertise."
                                    class="border border-[#03071288] rounded-md text-xs pl-2 w-full"
                                ></textarea>
                                <p class="text-[10px] text-gray-600">
                                    Max length: 150 characters.
                                </p>
                            </div>
                        </div> -->
                    </div>
                    <div id="privacyAndSecurity" class="mb-5">
                        <h3 class="font-semibold">Privacy & Security</h3>
                        <h6 id="updateAvatar" class="text-sm font-medium">
                            Change Password
                        </h6>
                        <div class="">
                            <!-- <label
                                for="password"
                                class="text-xs font-medium text-nowrap col-span-2"
                                >Current password</label
                            >
                            <input
                                type="password"
                                placeholder="Current password"
                                v-model="form.password"
                                class="border border-[#03071288] rounded-md mb-2 ml-3 text-xs pl-2 w-full col-span-10"
                            /> -->
                            <TextInput
                                name="New Password"
                                type="password"
                                v-model="form.password"
                                :message="form.errors.password"
                                class="flex gap-5 w-full ml-5 pr-5"
                            />

                            <div
                                class="text-[10px] text-gray-600 pl-5 mb-2 col-start-3 col-span-10"
                            >
                                <ul class="">
                                    <li>
                                        Minimum 8 characters, including at least
                                        1 uppercase letter, 1 lowercase letter,
                                        1 number, and 1 special character (e.g.,
                                        !, @, #, $).
                                    </li>
                                    <li>
                                        Avoid common words or sequences like
                                        "12345" or "password".
                                    </li>
                                </ul>
                            </div>
                            <TextInput
                                name="confirm password"
                                type="password"
                                v-model="form.password_confirmation"
                                class="flex gap-5 w-full ml-5 pr-5"
                            />
                            <p
                                class="text-[10px] text-gray-600 pl-5 mb-2 col-start-3 col-span-10"
                            >
                                Passwords must match.
                            </p>
                        </div>

                        <h6 id="updateName" class="text-sm font-medium">
                            Change Email
                        </h6>
                        <div class="">
                            <!-- <label
                                for="email"
                                class="text-xs font-medium text-nowrap col-span-2"
                                >Current email</label
                            >
                            <input
                                type="text"
                                :placeholder="$page.props.auth.user.email"
                                class="border border-[#03071288] rounded-md mb-2 ml-3 text-xs pl-2 w-full col-span-10"
                            /> -->
                            <TextInput
                                name=" New email"
                                type="email"
                                v-model="form.email"
                                :placeholder="$page.props.user.email"
                                :message="form.errors.email"
                                class="flex gap-5 w-full ml-5 pr-5"
                            />
                            <!-- <label
                                for="email"
                                class="text-xs font-medium text-nowrap col-span-2 mb-2"
                                >New email</label
                            >
                            <input
                                type="text"
                                :placeholder="$page.props.auth.user.email"
                                class="border border-[#03071288] rounded-md mb-2 ml-3 text-xs pl-2 w-full col-span-10"
                            /> -->
                        </div>
                        <div class="flex justify-end mt-3">
                            <button
                                class="text-xs border rounded-lg py-1.5 px-3 text-nowrap border-[#030712] bg-[#030712] text-white ease-in duration-100"
                                :disabled="form.processing"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </form>
                <!-- <form @submit.prevent="submit">
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
                </form> -->
            </div>
        </div>
    </div>
</template>
