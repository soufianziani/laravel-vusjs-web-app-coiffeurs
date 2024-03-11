<script setup>
import Card from '@/Components/Card.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { router } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    stores: {
        type: Array,
    },
    types: {
        type: String,
    },
    city: {
        type: String
    }
});

const handelShow = (type, city, id) => {
    router.get(route('showList.show', { type, city, id }));
}
console.log(props.types.title)
</script>
<template>
    <GuestLayout>

        <div class=" w-full flex lg:flex-row flex-col mx-4">
            <div class="mt-52 lg:w-1/2">
                <div class="w-full">
                    <h2 class="font-semibold">Sélectionnez un salon</h2>
                    <h1>{{ types.title }} {{ city }}</h1>
                </div>
                <Card class="mt-4" v-for="store, index in stores" :key="index" :title="store.name" :address="store.location"
                    @show="handelShow(types.name, city, store.id)" rating="5.9 "
                    :imageUrl="store.images.length > 0 ? `/storage/${store.images[0].filename}` : 'https://i.ibb.co/vsQjKmg/Group-4.jpg'" />
            </div>
            <div class="lg:w-1/2  mt-52 ">
            </div>
        </div>
    </GuestLayout>
</template>