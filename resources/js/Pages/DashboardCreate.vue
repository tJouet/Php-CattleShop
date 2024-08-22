<template>
    <Head title="Create" /><AuthenticatedLayout>
        <div class="container mx-auto mt-6">
            <h2 class="text-2xl font-bold mb-4">Creation form</h2>
            <form @submit.prevent="submitForm" class="space-y-4 flex flex-col">
                <div v-for="formInput in formInputs">
                    <label :for="formInput.value" class="block font-semibold"
                        >{{ formInput.label }}:
                    </label>
                    <input
                        :type="formInput.type"
                        v-model="form[formInput.value]"
                        :step="formInput.step ?? formInput.step"
                        :min="formInput.min ?? formInput.min"
                        class="mt-1 p-2 w-full border rounded-md"
                        required
                    />
                </div>
                <button
                    type="submit"
                    class="bg-blue-500 text-white px-4 py-2 mr-6 rounded-md hover:bg-blue-600"
                >
                    Create animal
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref } from "vue";

interface FormTypes {
    [key: string]: string;
}

const formInputs = [
    { label: "Name", value: "name", type: "text" },
    { label: "Type", value: "type", type: "text" },
    { label: "Race", value: "race", type: "text" },
    { label: "Age", value: "age", type: "number", min: "1" },
    { label: "Price", value: "price", type: "number", step: "0.01", min: "0" },
    { label: "Description", value: "description", type: "text" },
];
const form = ref<FormTypes>({
    name: "",
    type: "",
    race: "",
    age: "",
    price: "",
    description: "",
    status: "available",
});

const submitForm = () => {
    router.post(`/dashboard/create`, form.value);
};
</script>
