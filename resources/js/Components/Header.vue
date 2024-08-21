<template>
    <header class="p-10 bg-blue-100">
        <div class="flex lg:justify-center lg:col-start-2"></div>
        <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-start">
            <a v-if="$page.props.auth.user" :href="route('dashboard')">
                Dashboard
            </a>

            <template v-else>
                <Link :href="route('login')"> Log in </Link>
            </template>
        </nav>
    </header>
</template>
<script setup lang="ts">
const props = defineProps<{
    canLogin?: boolean;
}>();
</script>
