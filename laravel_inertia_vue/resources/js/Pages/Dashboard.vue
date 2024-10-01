<script setup>
const props = defineProps({
    users: Object,
});
</script>

<template>
    <div class="min-h-screen">
        <div class="grid grid-cols-12 gap-4 px-10 py-10 max-w-[1200px] m-auto">
            <div
                class="col-span-4 row-span-6 rounded-2xl p-4 bg-[#f3f4f6] shadow-lg flex flex-col items-center"
            >
                <div>
                    <img
                        class="mb-5 mt-2 rounded-full w-32 h-32"
                        :src="
                            $page.props.auth.user.avatar
                                ? 'storage/' + $page.props.auth.user.avatar
                                : 'storage/avatars/default.jpg'
                        "
                    />
                </div>
                <h3 class="font-semibold">{{ $page.props.auth.user.name }}</h3>
                <h4 class="bg-slate-300 px-3 my-2 rounded text-sm font-medium">
                    {{ $page.props.auth.user.is_admin ? "Admin" : "User" }}
                </h4>
                <h4 class="text-xs text-center">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit
                </h4>
                <div
                    class="flex items-center mt-4 gap-1 hover:underline hover:ease-in-out"
                >
                    <a href="/settings" class="text-[10px]">Edit Profile</a>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="9"
                        height="9"
                        fill="currentColor"
                        class="bi bi-pencil translate-y-[-1px]"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"
                        />
                    </svg>
                </div>
            </div>
            <div
                class="col-span-8 row-span-5 rounded-2xl p-4 bg-[#f3f4f6] shadow-lg flex items-center justify-center"
            >
                <p class="text-xs text-[#71717a]">Nothing to show here.</p>
            </div>
            <div
                class="col-start-5 col-span-8 row-span-10 rounded-2xl p-4 bg-[#f3f4f6] shadow-lg flex items-center justify-center"
            >
                <p class="text-xs text-[#71717a]">Nothing to show here</p>
            </div>
        </div>
    </div>
</template>
