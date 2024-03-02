<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  types: {
    type: Object,
  },
  owner_id: {
    type: Number,
  },
  isAuth: {
    type: Boolean,
  },
})

const form = useForm({
  name: '',
  description: '',
  location: '',
  city: '',
  type_id: 0,
  owner_id: props.owner_id,
  image: [],
  imagePreviewURLs:[],
  // Add other fields as necessary
});


const handelImage = (event) => {
  form.image = [];
  form.imagePreviewURLs = []; // Clear previous previews
  for (let i = 0; i < 12; i++) {
    form.image.push(event.target.files[i]);
    const reader = new FileReader();
    reader.onload = (e) => {
      form.imagePreviewURLs.push(e.target.result);
    };
    reader.readAsDataURL(event.target.files[i]);
  }
};
console.log(form.processing);


const submit = () => {
  form.post(route('store'), {
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
    <div class="w-1/2 ">
      <form class=" mx-10" @submit.prevent="submit">
        <div class="my-32">
          <h2 class="text-xl font-bold text-center">Create Store</h2>
          <div class="mt-4">
            <div class="mt-4">
              <label for="countries" class="block   text-black">Select Type</label>
              <select id="countries" v-model="form.type_id" class=" border text-black text-sm rounded block w-full  ">
                <option selected>Choose a country</option>
                <option v-for="(type, index) in types" :key="index" :value="type.id">{{ type.name }}</option>

              </select>
            </div>
            <div class="mt-4">
              <label for="name">Name</label>
              <TextInput type="text" id="name" v-model="form.name" />
            </div>
            <div class="mt-4">
              <label for="location">Location</label>
              <TextInput type="text" id="location" v-model="form.location" />
            </div>
            <div class="mt-4">
              <label for="city">City</label>
              <TextInput id="city" type="text" v-model="form.city" />
            </div>
            <div class="mt-4">
              <label for="description" class="block ">Description</label>
              <textarea id="description" v-model="form.description" rows="4"
                class="block p-2.5 w-full text-sm focus:outline-none ring-0 focus:ring-0 focus:border-black text-black bg-white rounded-lg border  "
                placeholder="Write your thoughts here..."></textarea>
            </div>
          </div>
          <div class="mt-4">
            <label>Upload image:</label>
            <div class="flex items-center justify-center w-full">
              <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-32 border-2 border-black  border-dashed rounded-lg cursor-pointer  ">
                <div v-if="form.imagePreviewURLs.length == 0"
                class="flex flex-col items-center justify-center pt-5 pb-6">
                  <svg class="w-8 h-8 mb-4 text-black " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                  </svg>
                  <p class="mb-2 text-sm text-black "><span class="font-semibold">Click to upload images of your
                      Store</span> or drag and drop</p>
                </div>
                
                <div class="mx-2" v-if="form.imagePreviewURLs.length > 0">
                  <div class="grid grid-cols-6  gap-1 w-full">
                    <div v-for="(image, index) in form.imagePreviewURLs" :key="index">
                      <img :src="image" alt="Uploaded Image" class=" rounded w-28 h-12">
                    </div>
                  </div>
                </div>
                <input id="dropzone-file" type="file" class="hidden" multiple @change="handelImage" />
              </label>
            </div>
          </div>


          <div class="mt-5">
            <PrimaryButton type="submit" :disabled="form.processing">Create</PrimaryButton>
          </div>
        </div>
      </form>
    </div>

    <template #background>
      <div class=" md:block hidden  w-1/2">
        <img src="@/Components/images/1.jpg" class="min-h-screen object-cover object-center" alt="">
      </div>
    </template>
  </GuestLayout>
</template>
  
  