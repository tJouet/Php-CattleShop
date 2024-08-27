<template>
    <Head title="Edit" /><AuthenticatedLayout>
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Edition form</h2>

            <div v-if="submitted" class="mt-4 p-4 bg-green-100 text-green-800">
                The animal's page had been updated
            </div>
            <form @submit.prevent="submitForm" class="space-y-4 flex flex-col">
                <div v-for="formInput in providedAnimalFormInputs">
                    <label :for="formInput.value" class="block font-semibold"
                        >{{ formInput.label }}:
                    </label>
                    <div v-if="formInput.type === 'select'">
                        <select
                            v-model="form[formInput.value]"
                            class="mt-1 p-2 w-full border rounded-md"
                            required
                        >
                            <!-- TO DO: Add a button to add a new animal type -->
                            <option
                                v-if="formInput.value === 'type'"
                                v-for="(option, index) in animalTypesOptions"
                                :key="index"
                                :value="option.value"
                            >
                                {{ option.label }}
                            </option>
                            <!-- TO DO: Sink this value with DB received value -->
                            <option
                                v-else-if="formInput.value === 'status'"
                                v-for="(option, index) in providedAnimalStatus"
                                :key="option.label"
                                :value="option.value"
                            >
                                {{ option.label }}
                            </option>
                        </select>
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

                <!-- TO DO: Add ways to upload a picture -->
                <div class="flex flex-row">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 mr-6 rounded-md hover:bg-blue-600"
                    >
                        Submit
                    </button>
                    <button
                        @click="putDownAnimal"
                        type="button"
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
import { PropType, ref } from "vue";
import { TypeAnimal } from "@/types/animals";
import { TypeFormInputs } from "@/types/formInputs";
import { AnimalStatus } from "@/types/animalStatus";

interface FormTypes {
    [key: string]: string | number | boolean;
}

const props = defineProps({
    providedAnimalTypes: {
        type: Array as PropType<string[]>,
        required: true,
    },
    providedAnimalFormInputs: {
        type: Array as PropType<TypeFormInputs[]>,
        required: true,
    },
    providedAnimalStatus: {
        type: Array as PropType<AnimalStatus[]>,
        required: true,
    },
    animal: {
        type: Object as PropType<TypeAnimal>,
        required: true,
    },
});
const submitted = ref(false);

const animalAvailabilty = ["available", "sold"];

const form = ref<FormTypes>({
    name: props.animal.name,
    age: props.animal.age,
    type: props.animal.type,
    race: props.animal.race,
    price: props.animal.price,
    description: props.animal.description,
    status: props.animal.status,
});
const files = ref<File[]>([]);

const animalTypesOptions: Array<{ label: string; value: string }> =
    props.providedAnimalTypes.map((animal: string) => ({
        label: animal.charAt(0).toUpperCase() + animal.slice(1),
        value: animal,
    }));

const handleFileChange = (event: Event) => {
    const target = event.target as HTMLInputElement;
    if (target.files) {
        files.value = Array.from(target.files);
    }
};

const submitForm = () => {
    submitted.value = true;
    const formData = new FormData();

    formData.append("_method", "PATCH");
    Object.keys(form.value).forEach((key) => {
        formData.append(key, form.value[key].toString());
    });

    files.value.forEach((file) => {
        formData.append("images[]", file);
    });

    const url = `/dashboard/${props.animal.id}`;
    router.visit(url, {
        method: "post",
        data: formData,
        preserveState: true,
        replace: true,
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });
};

const putDownAnimal = async () => {
    const url = `/dashboard/${props.animal.id}`;

    try {
        await router.delete(url, {
            onBefore: () =>
                confirm("Are you sure you want to delete this animal?"),
            preserveState: true,
            replace: true,
        });
    } catch (error) {
        console.error("Failed to delete the animal:", error);
    }
};
</script>
