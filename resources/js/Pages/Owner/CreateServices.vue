<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import Footer from '@/Components/Footer.vue';
import { computed, ref } from 'vue';

const props = defineProps({
  store_id: {
    type: Number,
    required: true
  },
  categories: {
    type: Array,
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
  form.post(route('store.service'), {
    onSuccess: () => {
      message.value = 'created Service successfully!';
      setTimeout(() => {
        message.value = '';
        form.name = '';
        form.price = 0;
        form.duration = 0;
        form.category_id = null;
      }, 2000);
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

</script>

<template>
  <button @click="router.post(route('owner.logout'))"
    class="fixed  bg-black text-white py-2 duration-200 rounded  mt-3 flex right-5 hover:shadow-none hover:translate-y-1 shadow-lg px-4">
    Logout
  </button>
  <div class="flex justify-center bg-gray-100 items-center  min-h-screen">
    <div class="max-w-2xl w-full bg-white p-8 border">
      <h2 class="text-xl font-bold mb-2 text-center">Create Services</h2>
      <div class="text-center h-8 text-green-500 ">
        {{ message }}
      </div>
      <div class="text-center text-red-500">
        <p v-if="errorMessage">{{ errorMessage }}</p>
      </div>
      <form @submit.prevent="submit">
        <div>
          <InputLabel for="type">Category:</InputLabel>
          <select :disabled="isCategoryEmpty"
            class="w-full rounded focus:ring-0 focus:outline-none disabled:opacity-40 focus:border-black "
            v-model="form.category_id">
            <option value="">Select Type</option>
            <option v-for="(cate, index) in categories" :key="index" :value="cate.id">{{ cate.name }}</option>

          </select>
        </div>
        <div>
          <InputLabel class="mt-4" for="name">Name:</InputLabel>
          <TextInput type="text" id="name" placeholder="Enter your name" v-model="form.name" />
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
  </div>
  <Footer />
</template>
