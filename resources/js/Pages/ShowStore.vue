<script setup>
import Footer from '@/Components/Footer.vue'
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
const props = defineProps({
    store: {
        type: Array,
    },
    worktime: {
        type: Array
    },
    services: {
        type: Array
    }
})



const displayDuration = (duration) => {
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
}

const showImage = ref(false)
const openModel = ref(false)

const openImageModal = (image) => {
    showImage.value = image;
    openModel.value = false
};

const closeModal = () => {
    showImage.value = null;
    openModel.value = true

};

const toggleModelImages = () => {
    openModel.value = !openModel.value
}

const handleSend = (store_id, service_id) => {
    router.get(route('reserve', { store_id, service_id }));
}


console.log(props.store)
console.log(props.store.images.length)

</script>
<template>
    <div class="bg-gray-100">
        <div>
            <div>
                <div class=" max-w-screen-lg mx-auto ">
                    <div class="flex items-end mx-2  justify-between">
                        <div class="flex flex-col gap-2 mt-10">
                            <h1 class="text-xl font-semibold">{{ store.name }}</h1>
                            <div>
                                <p class="cursor-pointer text-sm text-gray-600 underline">{{ store.location }} , 75004
                                    {{ store.city.name }}</p>
                            </div>
                            <div class=" ">
                                <p class="text-sm text-gray-600">5.0 (147 avis) . €€</p>
                            </div>
                        </div>
                        <div>
                            <button class="rounded-lg bg-black p-2 text-sm mt-10 text-white">Prendre RDV</button>
                        </div>
                    </div>
                    <div>
                        <!-- images -->
                        <div class="rounded mx-2 my-3">
                            <div v-if="store.images.length == 1" class="grid w-full gap-2 ">
                                <div class="h-full w-full ">
                                    <img :src="`/storage/${store.images[0].filename}`"
                                        class="w-full rounded object-cover sm:h-96 h-full max-h-96" alt="">
                                </div>
                            </div>
                            <div v-if="store.images.length == 2"
                                class="grid  w-full gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                                <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                    <img :src="`/storage/${store.images[0].filename}`"
                                        class="w-full rounded object-cover sm:h-96 h-full max-h-96" alt="">
                                </div>
                                <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                    <img :src="`/storage/${store.images[1].filename}`"
                                        class="w-full rounded object-cover sm:h-96 h-full max-h-96" alt="">
                                </div>
                            </div>
                            <div v-if="store.images.length == 3"
                                class="grid  w-full gap-2 rounded sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                                <div class="h-full w-full cursor-pointer " @click="toggleModelImages">
                                    <img :src="`/storage/${store.images[0].filename}`"
                                        class="w-full rounded object-cover sm:h-96  h-full max-h-96" alt="">
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                        <img :src="`/storage/${store.images[1].filename}`"
                                            class="w-full rounded object-cover sm:h-96 h-full max-h-96" alt="">
                                    </div>
                                    <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                        <img :src="`/storage/${store.images[2].filename}`"
                                            class="w-full rounded object-cover sm:h-96 h-full max-h-96" alt="">
                                    </div>
                                </div>
                            </div>
                            <div v-if="store.images.length == 4"
                                class="grid w-full gap-2 rounded sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                                <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                    <img :src="`/storage/${store.images[0].filename}`"
                                        class="w-full rounded object-cover sm:h-96 h-full max-h-96" alt="">
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                        <img :src="`/storage/${store.images[1].filename}`"
                                            class="w-full rounded object-cover sm:h-96 h-full max-h-96" alt="">
                                    </div>
                                    <div class="grid gap-2">
                                        <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                            <img :src="`/storage/${store.images[2].filename}`"
                                                class="w-full rounded object-cover sm:h-[188px]  h-full max-h-96"
                                                alt="">
                                        </div>
                                        <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                            <img :src="`/storage/${store.images[3].filename}`"
                                                class="w-full rounded object-cover sm:h-[188px] h-full max-h-96" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="store.images.length == 5"
                                class="grid  w-full gap-2 rounded gird md:grid-cols-2 sm:grid-cols-2">
                                <div class="h-full w-full cursor-pointer " @click="toggleModelImages">
                                    <img :src="`/storage/${store.images[0].filename}`"
                                        class="w-full rounded object-cover sm:h-96 h-full max-h-96" alt="">
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="grid gap-2">
                                        <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                            <img :src="`/storage/${store.images[1].filename}`"
                                                class="w-full rounded object-cover sm:h-[188px] h-full max-h-96" alt="">
                                        </div>
                                        <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                            <img :src="`/storage/${store.images[2].filename}`"
                                                class="w-full rounded object-cover sm:h-[188px] h-full max-h-96" alt="">
                                        </div>
                                    </div>
                                    <div class="grid gap-2">
                                        <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                            <img :src="`/storage/${store.images[3].filename}`"
                                                class="w-full rounded object-cover sm:h-[188px] h-full max-h-96" alt="">
                                        </div>
                                        <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                            <img :src="`/storage/${store.images[4].filename}`"
                                                class="w-full rounded object-cover sm:h-[188px] h-full max-h-96" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="store.images.length > 5"
                                class="grid  w-full gap-2 rounded gird md:grid-cols-2 sm:grid-cols-2">
                                <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                    <img :src="`/storage/${store.images[0].filename}`"
                                        class="w-full rounded object-cover sm:h-96 h-full max-h-96" alt="">
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="grid gap-2">
                                        <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                            <img :src="`/storage/${store.images[1].filename}`"
                                                class="w-full rounded object-cover sm:h-[188px] h-full max-h-96" alt="">
                                        </div>
                                        <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                            <img :src="`/storage/${store.images[2].filename}`"
                                                class="w-full rounded object-cover sm:h-[188px] h-full max-h-96" alt="">
                                        </div>
                                    </div>
                                    <div class="grid gap-2">
                                        <div class="h-full w-full cursor-pointer" @click="toggleModelImages">
                                            <img :src="`/storage/${store.images[3].filename}`"
                                                class="w-full rounded object-cover sm:h-[188px] h-full max-h-96" alt="">
                                        </div>
                                        <div class="h-full relative w-full cursor-pointer" @click="toggleModelImages">
                                            <div
                                                class="absolute flex h-full w-full justify-center rounded bg-black bg-opacity-40 text-center  backdrop-blur-lg">
                                            </div>
                                            <div
                                                class="absolute flex h-full w-full select-none items-center justify-center text-xl text-white">
                                                +{{ store.images.length - 5 }} more</div>
                                            <img :src="`/storage/${store.images[4].filename}`"
                                                class="w-full rounded object-cover sm:h-[188px] h-full max-h-96" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="openModel" class="min-h-screen z-10 fixed inset-0 bg-black bg-opacity-85">
                            <div @click="toggleModelImages"
                                class="fixed cursor-pointer bg-white rounded drop-shadow-lg p-2 m-3 z-1 right-0">
                                <img src="@/Components/icons/close.svg" class="w-6" alt="">
                            </div>
                            <div class="overflow-auto max-h-screen">
                                <div class="grid lg:grid-cols-3 md:grid-cols-2 mt-40 mx-3 grid-cols-1 gap-2">
                                    <div v-for="image in store.images" class="p-2 flex justify-center items-center ">
                                        <button @click="openImageModal(image)">
                                            <img :src="`/storage/${image.filename}`"
                                                class="lg:h-96 h-full object-cover rounded-lg object-center" alt="">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="showImage" class="fixed inset-0 flex items-center justify-center min-h-screen bg-black bg-opacity-90 z-20">
                            <div class="absolute inset-0 "></div>
                            <div class="bg-white p-2 rounded-lg">
                                <div @click="closeModal"
                                class="fixed cursor-pointer bg-white rounded drop-shadow-lg p-2 top-0 m-3 z-1 right-0">
                                <img src="@/Components/icons/close.svg" class="w-6" alt="">
                            </div>
                                <img :src="`/storage/${showImage.filename}`" class="md:max-w-2xl sm:max-w-lg max-w-sm md:max-h-2xl sm:max-h-lg max-h-sm "
                                    alt="Modal Image">
                            </div>
                        </div>
                    

                    <!-- ----------------------------------------------------------------- -->
                </div>
                <div class=" flex lg:flex-row gap-2  mx-2 flex-col-reverse items-start  justify-between mt-5">
                    <div class="w-full">
                        <h1 class="text-xl font-bold">Réserver en ligne pour un RDV chez {{ store.name }}</h1>
                        <p>24h/24 - Paiement sur place - Confirmation immédiate</p>
                        <div class=" mt-10">
                            <p class="text-2xl font-bold ">Choix de la prestation</p>
                            <div v-for="category in store.categorie" :key="category.id">
                                <div class="mt-10" v-if="category.services && category.services.length > 0">
                                   <p class="font-semibold text-xl "> {{ category.name }}</p>
                                    <p class="text-sm text-gray-700">{{ category.description }}</p>
                                    <div class=" bg-white drop-shadow-lg rounded mt-2">
                                        <div v-for="(service, index) in category.services" :key="index">
                                            <div class="p-4  grid grid-cols-3 items-center justify-between">
                                                <p>{{ service.name }}</p>
                                                <div class="flex items-center justify-around">
                                                    <p>{{ service.price }}$</p>
                                                    <p>{{ displayDuration(service.duration) }}</p>
                                                </div>
                                                <button
                                                @click="handleSend(store.id,service.id)"
                                                class="bg-black text-white px-3 py-1 hover:opacity-80 rounded">
                                                    Choisir
                                                </button>
                                            </div>
                                            <hr v-if="index < category.services.length - 1" class=" mx-4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="my-10 bg-white rounded drop-shadow-lg">
                                <div v-for="(service, index) in services" :key="index">
                                    <div class="p-4  grid grid-cols-3  items-center justify-between">
                                        <p>{{ service.name }}</p>
                                        <div class="flex items-center justify-around">
                                            <p>{{ service.price }}$</p>
                                            <p>{{ displayDuration(service.duration) }}</p>
                                        </div>
                                        <button 
                                        @click=handleSend(store.id,service.id)
                                         class="bg-black text-white px-3 py-1 hover:opacity-80 rounded">
                                            Choisir
                                        </button>
                                    </div>
                                    <hr v-if="index < services.length - 1" class=" mx-4">
                                </div>
                            </div>
                        </div>
                        <div>
                            <h2 class="font-semibold">À-propos</h2>
                            <div class="bg-white p-4 rounded drop-shadow-lg mt-2 mb-10">
                                <p>{{ store.description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class=" w-full sm:w-[600px] sm:mx-2 p-2 border drop-shadow-lg bg-white rounded-lg">
                        <h1 class="font-semibold text-xl text-center">Work Time </h1>
                        <div class="w-full  rounded  text-gray-600 bg-white" v-for="time, index in worktime">
                            <div class="flex items-center my-3 justify-between ">
                                <p :class="time.status !== 'closed' ? '' : 'font-semibold text-gray-900'">{{
                                time.day }}</p>
                                <div class=" ">
                                    <div v-if="time.status !== 'closed'" class="flex items-center gap-2">
                                        <p>{{ time.start_time }}</p>-
                                        <p>{{ time.end_time }}</p>
                                    </div>
                                    <p v-else class="font-semibold text-gray-900">Closed</p>
                                </div>
                            </div>
                            <hr v-if="index < 6">
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <Footer />
</template>