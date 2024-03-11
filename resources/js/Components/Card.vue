<script setup>
const props = defineProps({
    title: {
        type: String,
    },
    address: {
        type: String,
    },
    rating: {
        type: String,
    },
    imageUrl: {
        type: String,
    },
    altText: {
        type: String,
        default: 'Image'
    }
})

const emits = defineEmits(['show']);

</script>
<template>
    <div class="w-full">
        <div class="flex flex-col sm:flex-row rounded w-full  hover:scale-100 border border-opacity-0 border-gray-500 hover:border-opacity-20  scale-95 duration-300 gap-2 p-2">
            <img :src="imageUrl" class="rounded  min-w-80 h-48 object-cover object-center" :alt="altText">
            <div class="flex flex-col justify-between w-full">
                <div>
                    <h1 class="text-xl font-semibold">{{ title }}</h1>
                    <div class="flex mt-5 text-gray-800 gap-1">
                        <img src="https://www.svgrepo.com/show/523538/map-point.svg" class="w-4 text-black" alt="">
                        <p>{{ address }}</p>
                    </div>
                    <div class="flex items-center mt-2 gap-1">
                        <img src="https://www.svgrepo.com/show/526669/star.svg" class="w-4" alt="">
                        <p>{{ rating }}</p>
                    </div>
                </div>
                <button 
                @click="$emit('show')"
                class="bg-black p-3 text-white rounded w-full mt-4 sm:mt-0">Prendre RDV</button>
            </div>
        </div>
    </div>
</template>

