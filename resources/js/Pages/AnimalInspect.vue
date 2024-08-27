<template>
    <Head title="Animal display" />
    <Header :canLogin="true" />

    <div
        class="m-6 rounded-lg flex md:flex-row flex-col-reverse bg-lightPink p-6 md:text-lg"
    >
        <div
            class="md:w-[50%] w-full flex flex-col justify-center gap-6 my-6 md:my-0 md:pr-6"
        >
            <h1 class="font-bold text-4xl self-center md:self-start">
                {{ animal.name }}
            </h1>
            <div class="flex flex-row w-full justify-between md:text-2xl">
                <p>{{ animal.type }}</p>
                <p>{{ animal.race }}</p>
            </div>
            <p>
                {{ animal.description }}
            </p>
            <div class="self-start">
                Price: {{ getTaxedPrice(animal.price) }}€
            </div>
            <h2 class="text-lg md:text-2xl font-bold">
                Want to buy this animal?
            </h2>
            <p :class="animal.status === 'available' ? 'block' : 'hidden'">
                He's available!
            </p>
            <p :class="animal.status === 'sold' ? 'block' : 'hidden'">
                Infortunatly he found a forever house!
            </p>
            <h2 class="text-lg md:text-2xl font-bold">
                Contact the owner for more informations:
            </h2>
            <div class="md:flex md:flex-row w-full gap-2">
                <p>{{ animal.owner.name }}:</p>
                <p>{{ animal.owner.phone }}</p>
            </div>
        </div>
        <div class="md:w-[50%] w-full h-full">
            <carousel :items-to-show="1">
                <slide v-for="(image, index) in animal.images" :key="index">
                    <img
                        :src="`/storage/images/${image.url}`"
                        :alt="animal.name"
                        class="object-cover"
                    />
                </slide>
                <template #addons>
                    <navigation />
                </template>
            </carousel>
        </div>
    </div>
</template>
<script setup lang="ts">
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Navigation } from "vue3-carousel";
import Header from "../Components/Header.vue";
import { Head } from "@inertiajs/vue3";

interface Animal {
    images: { url: string; animal_id: number }[];
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

const getTaxedPrice = (price: number) => {
    let taxedPrice = price + price * 0.2;
    return taxedPrice.toFixed(2);
};
const props = defineProps<{ animal: Animal }>();
</script>
