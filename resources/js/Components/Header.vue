<template>
    <div class="p-10 bg-blue-100 flex flex-row w-full justify-between">
        <h1>Mink family market</h1>
        <nav v-if="props.canLogin">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')">
                Dashboard
            </Link>
            <Link :href="route('login')"> Log in </Link>
        </nav>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
const props = defineProps<{
    canLogin?: boolean;
}>();
</script>
