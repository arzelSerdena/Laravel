<script setup></script>
<template>
    <h3 class="font-semibold">Edit Profile</h3>

    <div class="flex pl-3 items-center gap-5 my-4">
        <input type="file" @input="change" id="avatar" hidden />

        <img
            class="rounded-full w-20 h-20 object-cover"
            :src="form.preview ?? 'storage/avatars/default.png'"
        />
        <div class="">
            <label
                for="avatar"
                class="cursor-pointer text-xs border border-[#03071288] rounded-lg py-1 px-3 mb-3 hover:border-[#030712] hover:bg-[#030712] hover:text-white ease-in duration-100 w-max"
            >
                Update Avatar
            </label>
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

    <div class="flex pl-3">
        <TextInput
            name="name"
            v-model="form.name"
            :message="form.errors.name"
            :placeholder="$page.props.auth.user.name"
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
</template>
