<template>
    <Head title="HomePage" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header
                    class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3"
                >
                    <div class="flex lg:justify-center lg:col-start-2"></div>
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>
                <!-- START MAIN -->
                <main class="mt-6">
                    <div class="navbar bg-base-300 rounded-box mt-6">
                        <div class="flex-1 px-2 lg:flex-none">
                            <a class="text-lg font-bold">{{ filter }}:</a>
                        </div>
                        <div class="flex flex-1 justify-end px-2">
                            <div class="flex items-stretch">
                                <a class="btn btn-ghost rounded-btn">Button</a>
                                <select
                                    v-model="filter"
                                    @change="
                                        (e) =>
                                            selectSortOption(e?.target?.value)
                                    "
                                    class="rounded-md bg-gray-200 mr-4 text-black"
                                >
                                    <option disabled selected value="">
                                        -- Filter --
                                    </option>
                                    <option value="type">Type</option>
                                    <option value="price">Price</option>
                                    <option value="age">Age</option>
                                    <option value="owner">Owner</option>
                                    <option value="status">Status</option>
                                </select>
                                <select
                                    v-model="option"
                                    @change="
                                        (e) => selectOption(e?.target?.value)
                                    "
                                    class="rounded-md bg-gray-200 mr-4 text-black"
                                >
                                    <option disabled selected value="">
                                        -- Options --
                                    </option>
                                    <option
                                        :value="option"
                                        v-for="option in filterSortOptions"
                                    >
                                        {{ option }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h2 class="text-xl font-bold my-6">Animals List</h2>
                    <ul>
                        <li v-for="animal in animals" :key="animal.id">
                            <strong>{{ animal.name }}</strong> -
                            {{ animal.type }} - {{ animal.race }} - Age:
                            {{ animal.age }} - Price: ${{ animal.price }} -
                            Owner: {{ animal.owner }}
                        </li>
                    </ul>
                </main>

                <footer
                    class="py-16 text-center text-sm text-black dark:text-white/70"
                >
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </footer>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from "vue";
import axios from "axios";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    animals: Array<{
        id: number;
        name: string;
        age: number;
        type: string;
        race: string;
        price: number;
        description: string;
        status: string;
        owner: string;
    }>;
}>();

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}

var filter = ref("");
const filterSortOptions = ref({});
const option = ref("");

const selectSortOption = (selectedFilter: string) => {
    filter.value = selectedFilter;
    switch (selectedFilter) {
        case "price":
            filterSortOptions.value = [
                "0-100",
                "100-200",
                "300-400",
                "400-500",
            ];
            break;
        case "age":
            filterSortOptions.value = ["0-5", "5-10", "10-15"];
            break;
        case "owner":
            filterSortOptions.value = ["TEST1", "TEST3", "TEST4"];
            break;
        case "status":
            filterSortOptions.value = ["Sold", "Available"];
            break;
        case "type":
            filterSortOptions.value = ["Dog", "Cat", "Bird"];
            break;
    }
};

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
    const url = `/filter-options?${queryString}`;
    console.log(url);
    router.visit(url, {
        method: "get",
        preserveState: true,
        replace: true,
    });
};
</script>
