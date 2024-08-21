<template>
    <Head title="Edit" /><AuthenticatedLayout>
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Edition form</h2>

            <div v-if="submitted" class="mt-4 p-4 bg-green-100 text-green-800">
                The animal's page had been updated
            </div>
            <form @submit.prevent="submitForm" class="space-y-4 flex flex-col">
                <div>
                    <label for="name" class="block font-semibold">Name:</label>
                    <input
                        type="text"
                        v-model="form.name"
                        class="mt-1 p-2 w-full border rounded-md"
                        required
                    />
                </div>

                <div>
                    <label for="price" class="block font-semibold"
                        >Price:</label
                    >
                    <input
                        type="number"
                        step="0.01"
                        v-model="form.price"
                        class="mt-1 p-2 w-full border rounded-md"
                        required
                    />
                </div>
                <div>
                    <label for="age" class="block font-semibold">Age:</label>
                    <input
                        type="number"
                        v-model="form.age"
                        class="mt-1 p-2 w-full border rounded-md"
                        required
                    />
                </div>
                <div>
                    <label for="description" class="block font-semibold"
                        >Description:</label
                    >
                    <textarea
                        v-model="form.description"
                        class="mt-1 p-2 w-full border rounded-md"
                        rows="4"
                        required
                    ></textarea>
                </div>
                <label for="status" class="flex flex-row">
                    Availability:
                    <input type="checkbox" class="mx-6" v-model="form.status" />
                    <p>Is available to purchase</p>
                </label>

                <div class="flex flex-row">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 mr-6 rounded-md hover:bg-blue-600"
                    >
                        Submit
                    </button>
                    <button
                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600"
                    >
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps<{
    animal: any;
}>();

const submitted = ref(false);

const form = ref({
    name: props.animal.name,
    age: props.animal.age,
    price: props.animal.price,
    description: props.animal.description,
    status: props.animal.status,
});

const submitForm = () => {
    console.log("Form Data:", form.value);
    submitted.value = true;

    const queryParams = new URLSearchParams();

    queryParams.append("name", form.value.name);
    queryParams.append("age", form.value.age);
    queryParams.append("description", form.value.description);
    queryParams.append("price", form.value.price);
    queryParams.append(
        "status",
        form.value.status === true ? "available" : "sold"
    );

    const queryString = queryParams.toString();

    const url = `/dashboard/${props.animal.id}`;
    router.visit(url, {
        method: "patch",
        data: Object.fromEntries(queryParams),
        preserveState: true,
        replace: true,
    });
};
</script>
