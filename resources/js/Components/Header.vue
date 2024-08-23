<template>
    <div
        class="md:p-10 py-10 px-4 flex flex-row w-full justify-between items-center text-white text-[20px]"
        style="
            background: rgba(0, 0, 0, 0.55)
                url('/storage/images/headerLandscape.jpg');
            background-blend-mode: darken;
            background-size: cover;
            background-position: center;
        "
    >
        <h1 class="md:text-[64px] text lg font-bold drop-shadow-2xl">
            <a href="/">Mink family market</a>
        </h1>
        <nav v-if="props.canLogin">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')">
                Dashboard
            </Link>
            <Link v-else :href="route('login')"> Log in </Link>
        </nav>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
const props = defineProps<{
    canLogin?: boolean;
}>();
</script>

<style>
.strokedtext {
    -webkit-text-stroke: 1px #111726;
}
</style>
