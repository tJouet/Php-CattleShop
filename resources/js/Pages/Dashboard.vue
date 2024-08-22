<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header> <Header /> </template>
        <div class="flex flex-col justify-center items-start m-6 gap-6">
            <h2 class="text-[32px]">My animals</h2>

            <table class="table table-zebra bg-white">
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
                                    route('dashboard.edit', {
                                        id: animal.id,
                                    })
                                "
                                class="mx-6 bg-lightPink p-2 rounded-md"
                            >
                                Edit
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <a
                :href="route('dashboard.create')"
                class="bg-white border-blue-200 border-2 py-4 px-6 rounded-md"
            >
                Create a new animal
            </a>
        </div>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import Header from "@/Components/Header.vue";
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
