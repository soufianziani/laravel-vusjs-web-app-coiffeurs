<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    store_id:{
        type: Number,
        required: true
    },
})

const form = useForm({
    name: '',
    store_id:props.store_id,
});



const submit = () => {
    form.post(route('store.categorie'), {
        onSuccess: () => {
            console.log('Successfully created!');
        },
        onError: (error) => {
            console.error(error);
        }
    });
    
};
</script>
<template>
    <GuestLayout>
   <div class="w-1/2">
    <h2>Create Store</h2>
    <form @submit.prevent="submit">
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="form.name">
      </div>
      <!-- Add other fields as necessary -->
      <button type="submit">Create</button>
    </form>
  </div>
  <template #background>
            <div class=" md:block hidden  w-1/2">
                <img src="@/Components/images/1.jpg" class="min-h-screen object-cover object-center" alt="">
            </div>
        </template>
  </GuestLayout>
</template>
  
  