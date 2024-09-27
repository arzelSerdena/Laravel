<script setup>
const model = defineModel({
    type: null,
    required: true,
});

defineProps({
    name: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "text",
    },
    placeholder: {
        type: String,
        default: "",
    },
    message: String,
});
</script>

<template>
    <div class="">
        <label class="text-nowrap">{{ name }}</label>
        <input
            :type="type"
            v-model="model"
            :placeholder="placeholder"
            :class="{ '!ring-red-500': message }"
        />
        <small class="error" v-if="message">{{ message }}</small>
    </div>
</template>
