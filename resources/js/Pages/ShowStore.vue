<script setup>
import Footer from '@/Components/Footer.vue'
const props = defineProps({
    store: {
        type: Array,
    },
    worktime: {
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

console.log(props.store)

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
                        <div class="mt-8 flex flex-col items-center mx-2 gap-2 sm:flex-row">
                            <div class=" sm:w-1/2">
                                <img src="https://res.cloudinary.com/planity/image/upload/x_0,y_47,w_1280,h_762,c_crop/t_d_main,f_auto/wkmy6enb3knqnryibdhi"
                                    class="cursor-pointer rounded h-96 object-cover object-center w-full" />
                            </div>
                            <div class="hidden  w-1/2 grid grid-cols-2 gap-2 ">
                                <img src="https://res.cloudinary.com/planity/image/upload/x_0,y_47,w_1280,h_762,c_crop/t_d_main,f_auto/wkmy6enb3knqnryibdhi"
                                    class="cursor-pointer rounded  h-96 object-cover object-center w-full" />
                                <img src="https://res.cloudinary.com/planity/image/upload/x_0,y_47,w_1280,h_762,c_crop/t_d_main,f_auto/wkmy6enb3knqnryibdhi"
                                    class="cursor-pointer rounded h-96 object-cover object-center w-full" />
                            </div>
                            <div class=" sm:w-1/2 grid grid-cols-2 gap-2 ">
                                <img src="https://res.cloudinary.com/planity/image/upload/x_0,y_47,w_1280,h_762,c_crop/t_d_main,f_auto/wkmy6enb3knqnryibdhi"
                                    class="cursor-pointer rounded  h-96 object-cover object-center w-full" />
                                <div class="grid gap-2">
                                    <img src="https://res.cloudinary.com/planity/image/upload/x_0,y_47,w_1280,h_762,c_crop/t_d_main,f_auto/wkmy6enb3knqnryibdhi"
                                        class="cursor-pointer rounded  h-full object-cover object-center w-full" />
                                    <img src="https://res.cloudinary.com/planity/image/upload/x_0,y_47,w_1280,h_762,c_crop/t_d_main,f_auto/wkmy6enb3knqnryibdhi"
                                        class="cursor-pointer rounded  h-full object-cover object-center w-full" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 hidden  gap-2 sm:w-1/2">
                                <img src="https://res.cloudinary.com/planity/image/upload/x_0,y_47,w_1280,h_762,c_crop/t_d_main,f_auto/wkmy6enb3knqnryibdhi"
                                    class=" cursor-pointer rounded" width="" alt="" />
                                <img src="https://res.cloudinary.com/planity/image/upload/x_0,y_47,w_1280,h_762,c_crop/t_d_main,f_auto/wkmy6enb3knqnryibdhi"
                                    class="cursor-pointer rounded" width="" alt="" />
                                <img src="https://res.cloudinary.com/planity/image/upload/x_0,y_47,w_1280,h_762,c_crop/t_d_main,f_auto/wkmy6enb3knqnryibdhi"
                                    class="cursor-pointer rounded" width="" alt="" />
                                <div class="relative cursor-pointer">
                                    <div
                                        class="  absolute text-center flex justify-center w-full h-full blur-sm bg-black bg-opacity-20 backdrop-blur-sm rounded ">
                                    </div>
                                    <div
                                        class="  absolute text-xl text-white select-none flex justify-center h-full items-center  w-full">
                                        +16 more</div>
                                    <img src="https://res.cloudinary.com/planity/image/upload/x_0,y_47,w_1280,h_762,c_crop/t_d_main,f_auto/wkmy6enb3knqnryibdhi"
                                        class=" rounded" width="" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" flex  items-start  justify-between mt-5">
                        <div class="w-full mx-2">
                            <h1 class="text-xl font-bold">Réserver en ligne pour un RDV chez {{ store.name }}</h1>
                            <p>24h/24 - Paiement sur place - Confirmation immédiate</p>
                            <div class=" mt-10">
                                <p class="text-xl font-semibold ">Choix de la prestation</p>
                                <div v-for="category in store.categorie" :key="category.id">
                                    <div class="mt-10" v-if="category.services && category.services.length > 0">
                                        {{ category.name }}
                                        <div class=" bg-white drop-shadow-lg rounded mt-2">
                                            <div v-for="(service, index) in category.services" :key="index">
                                                <div class="p-4  grid grid-cols-3 items-center justify-between">
                                                    <p>{{ service.name }}</p>
                                                    <div class="flex items-center justify-around">
                                                        <p>{{ service.price }}$</p>
                                                        <p>{{ displayDuration(service.duration) }}</p>
                                                    </div>
                                                    <button
                                                        class="bg-black text-white px-3 py-1 hover:opacity-80 rounded">
                                                        Choisir
                                                    </button>
                                                </div>
                                                <hr v-if="index < category.services.length - 1"
                                                    class=" mx-4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" w-[600px] mx-2 p-2 border drop-shadow-lg bg-white rounded">
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