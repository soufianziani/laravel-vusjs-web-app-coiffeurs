<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { router , useForm } from '@inertiajs/vue3';

const props = defineProps({
    categories:{
        type:Array
    },
    storeId:{
        type:String
    }
})
const form = useForm({
    name: '',
    description: '',
    store_id: props.storeId,
});


const submit = () => {
    form.post(route('categories.store'), {
        onSuccess: () => {
            console.log('Successfully created!');
            form.reset();
        },
        onError: (error) => {
            console.error(error);
        }
    });
};
const deleteCategory = (id) => {
    router.post(route('category.delete', { id }));
};
</script>

<template>
    <DashboardLayout>
        <template #content>
            <h1 class="text-xl font-semibold text-center my-5">Create your categories </h1>
            <div class="flex flex-col gap-4">
                <div class="p-5 w-full border">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <InputLabel for="name">Name:</InputLabel>
                            <TextInput type="text" id="name" v-model="form.name" />
                        </div>
                        <div class="mb-4">
                            <InputLabel for="description">Description:</InputLabel>
                            <TextInput type="text" id="description" :required="false" v-model="form.description" />
                        </div>
                        <PrimaryButton type="submit" class="w-full">Create</PrimaryButton>
                    </form>
                </div>
                <div class="p-5 w-full border">
                    <table v-if="categories.length > 0" class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="category in categories" :key="category.id" >
                                <td class="border px-4 py-2">{{ category.name }}</td>
                                <td class="border px-4 py-2">{{ category.description }}</td>
                                <td class="border px-4 py-2">
                                    <div class="flex justify-center ">
                                    <div @click="deleteCategory(category.id)" class="w-6 h-6 cursor-pointer">
                                        <svg fill="#00000" viewBox="-32 0 512 512" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>delete</title><path d="M128 416Q114 416 105 407 96 398 96 384L96 176 64 176 64 128 144 128 144 96Q144 82 153 73 162 64 176 64L272 64Q286 64 295 73 304 82 304 96L304 128 384 128 384 176 352 176 352 384Q352 398 343 407 334 416 320 416L128 416ZM256 144L256 112 192 112 192 144 256 144ZM200 368L200 192 144 192 144 368 200 368ZM304 368L304 192 248 192 248 368 304 368Z"></path></g></svg>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="text-center text-gray-600 select-none">
                        No Categories Yet!
                    </div>
                </div>
            </div>
        </template>
    </DashboardLayout>
</template>
