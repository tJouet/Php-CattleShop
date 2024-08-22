<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header> </template>
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Race</th>
                        <th>Age</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="animal in userAnimals" :key="animal.id">
                        <td>{{ animal.name }}</td>
                        <td>{{ animal.type }}</td>
                        <td>{{ animal.race }}</td>
                        <td>{{ animal.age }}</td>
                        <td class="flex flex-row">
                            {{ animal.price }}€ -
                            <span class="md:block hidden"> Hors taxe</span>
                            <span class="md:hidden block"> HT</span>
                        </td>
                        <td>
                            <a
                                :href="
                                    route('dashboard.edit', { id: animal.id })
                                "
                                class="mx-6"
                            >
                                Edit
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
