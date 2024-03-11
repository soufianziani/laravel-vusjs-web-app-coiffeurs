<script setup>
import Footer from '@/Components/Footer.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    store_id: {
        type: Number,
        required: true
    },
    categories: {
        type: Object,
    }
})

const form = useForm({
    name: '',
    description: '',
    store_id: props.store_id,
});

const submit = () => {
    form.post(route('store.categorie'), {
        onSuccess: () => {
            console.log('Successfully created!');
            form.reset();
        },
        onError: (error) => {
            console.error(error);
        }
    });
};

const handelValidate = (id) => {
    router.get(route('services', { id }));
};

const deleteCategory = (id) => {
    router.post(route('catigorie.delete', { id }));
};
</script>

<template>
    <div>
        <div class="">
            <button @click="router.post(route('owner.logout'))"
                class="fixed top-0 z-0 right-0 m-1 bg-black text-white py-2 px-4 rounded duration-200 hover:bg-gray-900">
                Logout</button>
            <button @click="router.go(-1)"
                class="fixed top-0 left-0 m-1 bg-black text-white py-2 px-4 rounded duration-200 hover:bg-gray-900">
                Go back</button>
        </div>
        <div class="flex  justify-center items-center min-h-screen bg-gray-100">
            <div class="max-w-2xl z-10 w-full mt-60 mb-20 bg-white p-8 border rounded-lg shadow">
                <h2 class="text-xl font-bold text-center mb-6">Create categories</h2>
                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <InputLabel for="name">Name:</InputLabel>
                        <TextInput type="text" id="name" v-model="form.name" />
                    </div>
                    <div class="mb-4">
                        <InputLabel for="name">Description:</InputLabel>
                        <TextInput type="text" id="name" v-model="form.description" />
                    </div>
                    <PrimaryButton type="submit" class="w-full">Create</PrimaryButton>
                </form>
                <div v-if="categories.length > 0" class="mt-8">
                    <h1 class="text-xl font-bold text-center mb-4">Your categories:</h1>
                    <div>

                        <ul>
                            <li v-for="(category, index) in categories" :key="index" @click="deleteCategory(category.id)"
                                class=" mb-2 mr-2 inline-block border-gray-900 border-2  cursor-pointer shadow-none rounded-full bg-black pl-2  py-1 text-white  duration-200 scale-95 hover:scale-100 hover:shadow-lg">
                                <div class="flex items-center">
                                    {{ category.name }}
                                    <img src="@/Components/icons/close.svg" class="w-7 h-3 " alt=""
                                        style="filter: invert(100%) sepia(0%) saturate(7500%) hue-rotate(320deg) brightness(105%) contrast(101%);">
                                </div>
                            </li>

                        </ul>

                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button @click="handelValidate(store_id)"
                        class="px-4 py-2 text-white bg-black rounded-lg duration-300 hover:scale-100 scale-95 hover:shadow-lg">Validate</button>
                </div>
            </div>
        </div>
        <Footer />
    </div>
</template>
