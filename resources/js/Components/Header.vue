<template>
    <div
        class="p-10 flex flex-row w-full justify-between items-center text-white text-[20px]"
        style="
            background: rgba(0, 0, 0, 0.55)
                url('/storage/images/headerLandscape.jpg');
            background-blend-mode: darken;
            background-size: cover;
            background-position: center;
        "
    >
        <h1 class="text-[64px] font-bold drop-shadow-2xl">
            Mink family market
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
