<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";
import TextInput from "./Components/TextInput.vue";

const props = defineProps(["user"]);

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

const toggleRole = () => {
    form.patch(route("user.toggleRole", props.user.id));
};

const updateName = () => {
    form.patch(route("user.update", props.user.id));
};

const updateEmail = () => {
    form.patch(route("user.updateEmail", props.user.id));
};

const deleteUser = () => {
    form.delete(route("user.destroy", props.user.id));
};

const updateAvatar = () => {
    form.post(route("user.updateAvatar", props.user.id));
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
                <a href="#changeEmail" class="text-xs font-medium pl-5"
                    >Change Email</a
                >
                <a href="#role" class="text-sm font-medium">Role</a>
                <a
                    href="#deleteAccount"
                    class="text-sm font-medium text-red-700"
                    >Delete Account</a
                >
            </div>
            <div class="border-l-2 col-span-10 pl-5 h-full">
                <div id="editProfile">
                    <h3 class="font-semibold">Edit Profile</h3>

                    <!-- Update Avatar -->
                    <form @submit.prevent="updateAvatar" class="flex flex-col">
                        <div
                            id="updateAvatar"
                            class="flex pl-3 items-center gap-5 my-4"
                        >
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
                                <input
                                    type="file"
                                    @input="change"
                                    id="avatar"
                                    hidden
                                />

                                <img
                                    class="rounded-full w-20 h-20 object-cover"
                                    :src="
                                        form.preview ||
                                        (props.user.avatar
                                            ? '/storage/' + props.user.avatar
                                            : '/storage/avatars/default.png')
                                    "
                                />
                            </div>
                            <div class="">
                                <button
                                    class="cursor-pointer text-xs border border-[#03071288] rounded-lg py-1 px-3 mb-3 hover:border-[#030712] hover:bg-[#030712] hover:text-white ease-in duration-100 w-max"
                                    :disabled="form.processing"
                                >
                                    Update Avatar
                                </button>
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
                    </form>

                    <!-- Update Name -->
                    <form @submit.prevent="updateName">
                        <div
                            class="flex pl-3 items-center gap-5 mb-5"
                            id="updateName"
                        >
                            <TextInput
                                name="name"
                                v-model="form.name"
                                :message="form.errors.name"
                                :placeholder="$page.props.user.name"
                                class="flex gap-5 w-full mb-0"
                            />
                            <button
                                class="text-xs border rounded-lg py-1.5 px-3 text-nowrap border-[#030712] bg-[#030712] text-white ease-in duration-100"
                                :disabled="form.processing"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Privacy and Security -->
                <div id="privacyAndSecurity" class="mb-5">
                    <h3 class="font-semibold">Privacy & Security</h3>

                    <!-- Change Email -->
                    <h6 id="updateEmail" class="text-sm font-medium">
                        Change Email
                    </h6>
                    <form @submit.prevent="updateEmail" class="flex flex-col">
                        <div class="flex pl-3 items-center gap-5 mb-3">
                            <TextInput
                                name=" New email"
                                type="email"
                                v-model="form.email"
                                :placeholder="$page.props.user.email"
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

                <!-- Update Role -->
                <form @submit.prevent="toggleRole" id="role" class="mb-5">
                    <h3 class="text-[#030712] font-semibold">Role</h3>
                    <p class="text-[10px] mb-2 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit. Assumenda id labore consectetur explicabo alias
                        tenetur reiciendis! Iste dolor nesciunt saepe iusto
                        repellendus, et inventore cumque velit, aliquam voluptas
                        atque exercitationem.
                    </p>
                    <button
                        class="text-xs border rounded-lg py-1.5 px-3 text-nowrap mb-3"
                        :class="
                            $page.props.user.is_admin
                                ? 'border-[#030712] bg-[#030712] text-white'
                                : 'border-[#030712] bg-[#030712] text-white'
                        "
                        :disabled="form.processing"
                    >
                        {{
                            $page.props.user.is_admin
                                ? "Revoke Admin Access"
                                : "Make Admin"
                        }}
                    </button>
                </form>

                <!-- Delete Account -->
                <form @submit.prevent="deleteUser">
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
