<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    store_id:{
        type: Number,
        required: true
    },
    category:{
        type:Object,
    }
})

const form = useForm({
    name: '',
    price: 0,
    store_id:props.store_id,
    category_id:props.category.id,
});



const submit = () => {
    form.post(route('store.service'), {
        onSuccess: () => {
            console.log('Successfully created!');
        },
        onError: (error) => {
            console.error(error);
        }
    });
    form.name = '';
    form.price = 0 ;
    form.store_id = props.store_id;
    form.category_id = props.category.id;
};
</script>
<template>
    <GuestLayout>
   <div class="w-1/2">
    <h2>Create Store</h2>
    <form @submit.prevent="submit">
        <div>
          <label for="type">Category:</label>
          <select v-model="form.category_id">
            <option selected >Select Type</option>
            <option v-for="(cate,index) in category" 
            :key="index" :value="cate.id"
            >{{ cate.name }}</option>
          </select>
        </div>
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="form.name">
      </div>
      <div>
        <label for="price">Price:</label>
        <input type="number" id="name" v-model="form.price">
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
  
  