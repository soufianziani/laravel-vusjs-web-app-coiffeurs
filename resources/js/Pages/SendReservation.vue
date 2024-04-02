<script setup>
import { defineProps, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';


const props = defineProps({
    store: {
        type: Object
    },
    service: {
        type: Object
    },
    services: {
        type: Array
    },
    isAuth: {
        type: Boolean
    }
});



const moreService = ref(false);

const handelShowMoreService = () => {
    moreService.value = !moreService.value;
};

const selectedService = ref([props.service]);

const categoriesServices = ref([]);
categoriesServices.value = props.store.categorie.map(category => {
    const services = category.services.filter(item => item.id !== props.service.id);
    return { ...category, services };
});
const servicesNullCategory = ref(props.services.filter(service => service.id !== props.service.id)); // Filter out the initially selected service

const handelSelect = service => {
    selectedService.value.push(service);

    categoriesServices.value.forEach(category => {
        category.services = category.services.filter(item => item.id !== service.id);
    });
    servicesNullCategory.value = servicesNullCategory.value.filter(item => item.id !== service.id);
    moreService.value = !moreService.value;
};

const handelDelete = service => {
    selectedService.value = selectedService.value.filter(item => item.id !== service.id);

    categoriesServices.value.forEach(category => {
        if (category.id === service.category_id) {
            category.services.push(service);
        }
    });

    servicesNullCategory.value.push(service);
};

const displayDuration = duration => {
    if (duration >= 60) {
        const hours = Math.floor(duration / 60);
        const minutes = duration % 60;
        if (minutes === 0) {
            return `${hours} h`;
        } else {
            return `${hours}h ${minutes}min`;
        }
    } else {
        const durationString = duration.toString();
        if (durationString.endsWith('.00')) {
            return `${durationString.slice(0, -3)} min`; // Remove the ".00"
        } else {
            return `${duration} min`;
        }
    }
};

const validate = () => {
    const selectedServiceIds = selectedService.value.map(service => service.id);
    router.post(route('reserve.store'), {
        store_id: props.store.id,
        selectedServices_id: selectedServiceIds
    });
};
</script>
<template>
    <div class="bg-gray-100">
        <div class="max-w-screen-lg py-10 mx-auto min-h-screen">
            <div class="flex flex-col gap-2">
                <h1 class="text-xl font-semibold">{{ props.store.name }}</h1>
                <div>
                    <p class="cursor-pointer text-sm text-gray-600 underline">{{ props.store.location }}, 75004 {{
                    props.store.city.name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">5.0 (147 avis) . €€</p>
                </div>
            </div>
            <div class="my-12">
                <p class="text-xl font-semibold">Selected services</p>
                <div v-for="service in selectedService" :key="service.id" class="my-2 mt-4 bg-white rounded border">
                    <div class="p-4 grid grid-cols-3 items-center justify-between">
                        <p>{{ service.name }}</p>
                        <div class="flex items-center justify-around">
                            <p>{{ service.price }}$</p>
                            <p>{{ displayDuration(service.duration) }}</p>
                        </div>
                        <button @click="handelDelete(service)"
                            class="text-blue-500 underline px-3 text-end hover:opacity-80 rounded">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            <!-- Add a new Service -->
            <button v-if="!moreService " @click="handelShowMoreService"
                class="flex gap-2 items-center p-2 hover:opacity-90 rounded bg-black">
                <img src="@/Components/icons/add.svg" alt=""
                    style="filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(256deg) brightness(103%) contrast(101%);" />
                <p class="text-white">Add a service afterwards</p>
            </button>
            <div v-if="moreService">
                <div v-for="category in categoriesServices" :key="category.id">
                    <div class="my-10" v-if="category.services && category.services.length > 0">
                        <p class="font-semibold text-xl">{{ category.name }}</p>
                        <p class="text-sm text-gray-700">{{ category.description }}</p>
                        <div class="bg-white drop-shadow-md rounded mt-2">
                            <div v-for="(service, index) in category.services" :key="index">
                                <div class="p-4 mx-5 grid grid-cols-3 gap-2 items-center justify-between">
                                    <p>{{ service.name }}</p>
                                    <div class="flex items-center justify-around">
                                        <p>{{ service.price }}$</p>
                                        <p>{{ displayDuration(service.duration) }}</p>
                                    </div>
                                    <div class="text-end">
                                        <button @click="handelSelect(service)"
                                            class="bg-black w-fit text-white px-3 py-1 hover:opacity-80 rounded">
                                            Choisir
                                        </button>
                                    </div>
                                </div>
                                <hr v-if="index < category.services.length - 1" class="mx-4">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white drop-shadow-md rounded mt-24">
                    <div v-for="(service, index) in servicesNullCategory" :key="index">
                        <div class="p-4 mx-5 grid grid-cols-3 gap-2 items-center justify-between">
                            <p>{{ service.name }}</p>
                            <div class="flex items-center justify-around">
                                <p>{{ service.price }}$</p>
                                <p>{{ displayDuration(service.duration) }}</p>
                            </div>
                            <div class="text-end">
                                <button @click="handelSelect(service)"
                                    class="bg-black w-fit text-white px-3 py-1 hover:opacity-80 rounded">
                                    Choisir
                                </button>
                            </div>
                        </div>
                        <hr v-if="index < servicesNullCategory.length - 1" class="mx-4">
                    </div>
                </div>
            </div>
            <div v-if="!props.isAuth" class="bg-white p-10 mt-5 rounded-lg drop-shadow-sm">
                <h1 class="text-xl font-medium text-center">Not yet registered?</h1>
                <button @click="router.get(route('register'))"
                    class="p-3 border border-black hover:bg-black hover:text-white text-sm duration-300 w-full my-4 rounded-lg">
                    Create Account
                </button>
                <span class="flex items-center my-4">
                    <span class="h-px flex-1 bg-gray-200"></span>
                    <span class="shrink-0 px-6">or</span>
                    <span class="h-px flex-1 bg-gray-200"></span>
                </span>
                <h1 class="text-xl font-medium text-center">Already have an account?</h1>
                <button @click="router.get(route('login'))"
                    class="p-3 border bg-black w-full opacity-90 hover:opacity-100 text-sm text-white my-4 rounded-lg">
                    Login
                </button>
            </div>
            <div v-if="props.isAuth" @click="validate" class="my-10">
                <button class="p-3 text-white bg-black hover:opacity-95 text-sm rounded-lg w-full">Validate</button>
            </div>
        </div>
    </div>
    <Footer />
</template>
