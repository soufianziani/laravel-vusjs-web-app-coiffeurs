<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import Footer from '@/Components/Footer.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { computed, ref } from 'vue';

const props = defineProps({
    store_id: {
        type: Number,
        required: true
    },
    categories: {
        type: Array,
    },
    services: {
        type : Array,
    }
})
const isCategoryEmpty = computed(() => {
    return props.categories.length === 0;
});

const form = useForm({
    name: '',
    price: 0,
    store_id: props.store_id,
    duration: 0,
    category_id: null,
});

const message = ref('')
const errorMessage = ref('')

const submit = () => {
    form.post(route('services.store'), {
        onSuccess: () => {
            message.value = 'created Service successfully!';
            setTimeout(() => {
                message.value = '';
            }, 2000);
            form.name = '';
            form.price = 0;
            form.duration = 0;
            form.category_id = null;
        },
        onError: (error) => {
            if (error.response.status === 422) {
                errorMessage.value = error.response.data.errors;
            }
        },
        name: form.name,
        price: form.price,
        duration: form.duration,
        store_id: props.store_id,
        category_id: form.category_id,
    });

};

const deleteServices = (id)=> {
    router.post(route('service.delete' , {id}))
}

</script>

<template>
    <DashboardLayout>
            <template #content>
                <div class="flex flex-col gap-4">
                    <div class=" w-full  bg-white ">
                        <h1 class="text-xl font-semibold text-center ">Create your Services </h1>
                        <div class="text-center h-8 text-green-500 ">
                            {{ message }}
                        </div>
                        <div class="text-center text-red-500">
                            <p v-if="errorMessage">{{ errorMessage }}</p>
                        </div>
                        <form @submit.prevent="submit" class="border p-5">
                            <div>
                                <InputLabel for="type">Category:</InputLabel>
                                <select :disabled="isCategoryEmpty"
                                    class="w-full rounded focus:ring-0 focus:outline-none disabled:opacity-40 focus:border-black "
                                    v-model="form.category_id">
                                    <option value="">Select category</option>
                                    <option v-for="(cate, index) in categories" :key="index" :value="cate.id">{{ cate.name }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <InputLabel class="mt-4" for="name">Name:</InputLabel>
                                <TextInput type="text" id="name" placeholder="Service name" v-model="form.name" />
                                <p v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</p>
                            </div>
                            <div>
                                <InputLabel class="mt-4" for="price">Price:</InputLabel>
                                <TextInput :price="true" type="number" v-model="form.price" />
                                <p v-if="form.errors.price" class="text-red-500">{{ form.errors.price }}</p>
                            </div>
                            <div>
                                <InputLabel class="mt-4" for="duration">Duration:</InputLabel>
                                <TextInput :price="true" type="number" placeholder="Enter your service duration with (minute)"
                                    v-model="form.duration" />
                                <p v-if="form.errors.duration" class="text-red-500"></p>
                            </div>
                            <PrimaryButton class="mt-4" type="submit">Create</PrimaryButton>
                        </form>
                    </div>
                    <div class="p-5 w-full border">
                        <table v-if="categories.length > 0" class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Category_Name</th>
                                    <th class="px-4 py-2">Service_Name</th>
                                    <th class="px-4 py-2">Price</th>
                                    <th class="px-4 py-2">Duration</th>
                                    <th class="px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="service in services" :key="service.id" >
                                    <td class="border px-4 py-2">{{ service.category?.name || '-' }}</td>
                                    <td class="border px-4 py-2">{{ service.name }}</td>
                                    <td class="border px-4 py-2">{{ service.price }}</td>
                                    <td class="border px-4 py-2">{{ service.duration }}</td>
                                    <td class="border px-4 py-2">
                                        <div class="flex justify-center ">
                                        <div @click="deleteServices(service.id)" class="w-6 h-6 cursor-pointer">
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
