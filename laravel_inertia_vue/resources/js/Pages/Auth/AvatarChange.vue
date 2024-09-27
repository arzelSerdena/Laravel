<script setup>
import { reactive } from "vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    avatar: null,
    preview: null,
});

const change = (e) => {
    form.avatar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
};

const submit = () => {
    form.post(route("settings_avatar.update"));
};
</script>

<template>
    <form @submit.prevent="submit" class="flex flex-col">
        <div class="flex pl-3 items-center gap-5 my-4">
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
                    :src="
                        form.preview ??
                        'storage/' + $page.props.auth.user.avatar ??
                        'storage/avatars/default.png'
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
                <div class="text-[10px] text-gray-600 flex flex-col gap-[1px]">
                    <p>File size limit: 2MB.</p>
                    <p>Supported file formats: JPG, PNG.</p>
                    <p>
                        For best results, use a square image (recommended size:
                        512x512px).
                    </p>
                    <p>{{ form.errors.avatar }}</p>
                </div>
            </div>
        </div>
    </form>
</template>
