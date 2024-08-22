<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header> </template>
        <div class="py-12 mx-auto">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-400 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 bg-gray-400">Vos animaux</div>
                    <ul>
                        <li v-for="animal in userAnimals" :key="animal.id">
                            <strong>{{ animal.name }}</strong> -
                            {{ animal.type }} - {{ animal.race }} - Age:
                            {{ animal.age }} - Price: ${{ animal.price }}
                            <a
                                :href="
                                    route('dashboard.edit', { id: animal.id })
                                "
                                class="mx-6"
                            >
                                Edit
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <a :href="route('dashboard.create')" class="mx-6 bg-blue-200">
            Create a new animal
        </a>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

interface Animal {
    owner_id: number;
    owner: { name: string; id: number; phone: string };
    id: number;
    name: string;
    age: number;
    type: string;
    race: string;
    price: number;
    description: string;
    status: string;
}

const props = defineProps<{
    userAnimals: Array<Animal>;
}>();
</script>
