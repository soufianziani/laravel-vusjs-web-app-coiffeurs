<script setup>
import Footer from '@/Components/Footer.vue';
import OwnerLayout from '@/Layouts/OwnerLayout.vue';
import { router } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    types: {
        type: Array,
        required: true
    }
});

const create = (id) => {
    router.get(route('create', { id: id }));
}


</script>

<template>
    <OwnerLayout>
        <div class="flex justify-center min-h-screen">
            <div class="mx-5 my-20">
                <h1 class="font-bold text-6xl">Devenez partenaire</h1>
                <p class="text-lg mt-5">Plateforme de réservation n°1 au Maroc pour tous types d'établissements de beauté</p>
                <div class="grid grid-cols-1 mt-7 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                    <button @click="create(type.id)" v-for="(type ,index) in types" :key="index"
                        class="text-left py-20 border px-10 text-xl items-center hover:border-gray-300 hover:shadow-black bg-white hover:drop-shadow-2xl duration-200 font-semibold">
                        <img :src="`icons/type/${type.name}.svg`" class="w-16 h-16 m-3" alt="">
                        {{ type.description }}
                    </button>
                </div>
            </div>
        </div>
        <Footer />
    </OwnerLayout>
</template>         