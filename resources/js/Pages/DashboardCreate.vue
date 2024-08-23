<template>
    <Head title="Create" /><AuthenticatedLayout>
        <div class="container mx-auto mt-6">
            <h2 class="text-2xl font-bold mb-4">Creation form</h2>
            <form @submit.prevent="submitForm" class="space-y-4 flex flex-col">
                <div v-for="formInput in formInputs">
                    <label :for="formInput.value" class="block font-semibold"
                        >{{ formInput.label }}:
                    </label>
                    <div v-if="formInput.type === 'select'">
                        <select
                            v-model="form[formInput.value]"
                            class="mt-1 p-2 w-full border rounded-md"
                            required
                        >
                            <option
                                v-for="(option, index) in formInput.options"
                                :key="index"
                                :value="option.value"
                            >
                                {{ option.label }}
                            </option>
                        </select>
                        <!-- TO DO: Add a button to add a new animal type -->
                    </div>
                    <input
                        v-else-if="formInput.type === 'file'"
                        type="file"
                        @change="handleFileChange"
                        :class="formInput.class"
                        multiple
                    />
                    <input
                        v-else
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
import { PropType, ref } from "vue";

interface FormTypes {
    [key: string]: string;
}

const props = defineProps({
    animalTypes: {
        type: Array as PropType<string[]>,
        required: true,
    },
});
const form = ref<FormTypes>({
    name: "",
    type: "",
    race: "",
    age: "",
    price: "",
    description: "",
    status: "available",
});

const files = ref<File[]>([]);

const animalTypesOptions: Array<{ label: string; value: string }> =
    props.animalTypes.map((animal: string) => ({
        label: animal.charAt(0).toUpperCase() + animal.slice(1),
        value: animal,
    }));

const formInputs = [
    { label: "Name", value: "name", type: "text" },
    {
        label: "Type",
        value: "type",
        type: "select",
        options: animalTypesOptions,
    },
    { label: "Race", value: "race", type: "text" },
    { label: "Age", value: "age", type: "number", min: "1" },
    { label: "Price", value: "price", type: "number", step: "0.01", min: "0" },
    { label: "Description", value: "description", type: "text" },
    {
        label: "Pictures",
        value: "images",
        type: "file",
        class: "file-input w-full max-w-xs",
    },
];

const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files) {
        files.value = Array.from(target.files);
    }
};

const submitForm = async () => {
    console.log(form.value);
    const formData = new FormData();

    Object.keys(form.value).forEach((key) => {
        formData.append(key, form.value[key]);
    });

    files.value.forEach((file) => {
        formData.append("images[]", file);
    });

    try {
        await router.post(`/dashboard/create`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        console.log("Form submitted successfully!");
    } catch (error) {
        console.error("Error submitting form:", error);
    }
};
</script>
