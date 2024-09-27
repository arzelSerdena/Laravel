<script setup></script>

<template>
    <div class="bg-[#d1d5db]">
        <header class="">
            <nav>
                <div class="space-x-6">
                    <Link
                        :href="route('home')"
                        class="nav-link"
                        :class="{ 'bg-slate-700': $page.component === 'Home' }"
                        >Home</Link
                    >
                </div>
                <div v-if="$page.props.auth.user" class="space-x-6 flex">
                    <Link
                        :href="route('dashboard')"
                        class="nav-link"
                        :class="{
                            'bg-slate-700': $page.component === 'Dashboard',
                        }"
                        >Dashboard</Link
                    >
                    <Link
                        :href="route('settings')"
                        as="button"
                        type="button"
                        class="nav-link"
                        :class="{
                            'bg-slate-700': $page.component === 'Settings',
                        }"
                        >Settings</Link
                    >
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        type="button"
                        class="nav-link"
                        >Logout</Link
                    >
                    <!-- <img
                        class="avatar"
                        :src="
                            $page.props.auth.user.avatar
                                ? 'storage/' + $page.props.auth.user.avatar
                                : 'storage/avatars/default.png'
                        "
                        alt=""
                    /> -->

                    <!-- <button class="headerToggle">
                        
                    </button>
                    <div
                        class="text-[#030712] text-sm absolute top-[65px] right-[20px] flex flex-col bg-white p-5 z-50 rounded-lg gap-2 shadow-2xl headerHiddenDiv"
                    ></div> -->
                </div>
                <div v-else class="space-x-6">
                    <Link
                        :href="route('register')"
                        class="nav-link"
                        :class="{
                            'bg-slate-700': $page.component === 'Auth/Register',
                        }"
                        >Register</Link
                    >
                    <Link
                        :href="route('login')"
                        class="nav-link"
                        :class="{
                            'bg-slate-700': $page.component === 'Auth/Login',
                        }"
                        >Login</Link
                    >
                </div>
            </nav>
        </header>
        <main class="">
            <slot />
        </main>
    </div>
</template>
