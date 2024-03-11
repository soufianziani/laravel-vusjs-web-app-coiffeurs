<script setup>
import { router } from '@inertiajs/vue3';


const props = defineProps({
    types:{
        type:Array,
    },
    cities:{
        type:Array,
    }
});

const handelRoute = (type, city) => {
    router.get(route('listStore', { type, city }));
};

</script>
<template>
    <div class="px-4 mt-10 max-w-[700px]">
        <h1 class="text-3xl font-semibold">Trouver votre établissement beauté partout en Maroc</h1>
        <div v-for="type,index in types" :key="index" 
        class="my-10">
            <h2 class="text-xl font-semibold text-capitalize capitalize">{{ type.name }}</h2>
            <p>Nos salons de coiffure populaires en Maroc</p>
            <div class="grid grid-cols-4 gap-5 text-sm mt-3  mb-1">
                <button 
                @click="handelRoute(type.name, city.name)"
                v-for="city in cities" :key="city"  
                class="text-left ">{{ city.name }}</button> 
          
            </div>
        </div>
        

    </div>
</template>