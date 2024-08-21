<template>
    <Head title="HomePage" />
    <Header :canLogin="true" />
    <div class="flex flex-col items-center justify-center">
        <main class="w-full px-6">
            <div
                class="bg-red-300 rounded-md mt-6 justify-between items-center flex md:flex-row p-4 flex-col w-full"
            >
                <p v-if="filter" class="text-lg font-bold pb-4 md:pb-0">
                    {{ filter }} : {{ selectedOption?.label }}
                </p>
                <p v-else class="text-lg font-bold pb-4 md:pb-0">
                    Rechercher par
                </p>

                <div class="flex flex-row justify-evenly">
                    <select
                        v-model="filter"
                        @change="(e) => selectSortOption(e?.target?.value)"
                        class="rounded-md bg-gray-200 md:mr-4 text-black"
                    >
                        <option disabled selected value="">-- Filter --</option>
                        <option value="type">Type</option>
                        <option value="price">Price</option>
                        <option value="age">Age</option>
                        <option value="owner">Owner</option>
                        <option value="status">Status</option>
                    </select>
                    <select
                        v-model="option"
                        @change="(e) => selectOption(e?.target?.value)"
                        class="rounded-md bg-gray-200 text-black md:mr-4"
                    >
                        <option disabled selected value="">
                            -- Options --
                        </option>
                        <option
                            v-for="filterOption in filterSortOptions"
                            :value="filterOption.value"
                            :key="filterOption.value"
                        >
                            {{ filterOption.label }}
                        </option>
                    </select>
                </div>
            </div>
            <h2 class="text-xl font-bold my-6">Animals List</h2>
            <ul>
                <li v-for="animal in animals" :key="animal.id">
                    <strong>{{ animal.name }}</strong> - {{ animal.type }} -
                    {{ animal.race }} - Age: {{ animal.age }} - Price: ${{
                        animal.price
                    }}
                    - Owner: {{ animal.owner.name }} {{ animal.owner.phone }}
                </li>
            </ul>
        </main>
    </div>
</template>

<script setup lang="ts">
import Header from "../Components/Header.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, defineProps, computed } from "vue";

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
interface User {
    id: number;
    name: string;
}
const props = defineProps<{
    animals: Array<Animal>;
    users: Array<User>;
    animalsSearchOptions: any;
}>();

var filter = ref("");
const filterSortOptions = ref<{ label: string; value: string | number }[]>([]);
const option = ref("");

const selectSortOption = (selectedFilter: string) => {
    filter.value = selectedFilter;
    switch (selectedFilter) {
        case "price":
            filterSortOptions.value = [
                {
                    label: "0-100",
                    value: "0-100",
                },
                {
                    label: "100-200",
                    value: "100-200",
                },
                {
                    label: "300-400",
                    value: "300-400",
                },
                {
                    label: "300-400",
                    value: "300-400",
                },
                {
                    label: "400-500",
                    value: "400-500",
                },
            ];
            break;
        case "age":
            filterSortOptions.value = [
                {
                    label: "0-5",
                    value: "0-5",
                },
                {
                    label: "6-10",
                    value: "6-10",
                },
                {
                    label: "11-15",
                    value: "11-15",
                },
            ];
            break;
        case "owner":
            filterSortOptions.value = props.users.map((user) => ({
                label: user.name,
                value: user.id,
            }));
            break;
        case "status":
            filterSortOptions.value = [
                {
                    label: "Sold",
                    value: "sold",
                },
                {
                    label: "Available",
                    value: "available",
                },
            ];
            break;
        case "type":
            filterSortOptions.value = [
                {
                    label: "Dog",
                    value: "dog",
                },
                {
                    label: "Cat",
                    value: "cat",
                },
                {
                    label: "Sheep",
                    value: "sheep",
                },
            ];
            break;
    }
};

const selectedOption = computed(() => {
    return filterSortOptions.value.find(
        (o) => o.value.toString() === option.value
    );
});

const selectOption = (selectedOption: string) => {
    option.value = selectedOption;
    applyFilter();
};

const applyFilter = () => {
    const queryParams = new URLSearchParams();
    if (filter.value) {
        queryParams.append("filter", filter.value);
    }
    if (filterSortOptions.value) {
        queryParams.append("sort_option", option.value);
    }
    const queryString = queryParams.toString();

    const url = `/?${queryString}`;
    router.visit(url, {
        method: "get",
        preserveState: true,
        replace: true,
    });
};
</script>
