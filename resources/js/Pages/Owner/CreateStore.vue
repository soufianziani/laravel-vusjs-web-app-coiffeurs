<script setup>
import Footer from '@/Components/Footer.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
  owner_id: {
    type: Number,
  },
  type_id: {
    type: Number,
  },
  isAuth: {
    type: Boolean,
  },
  cities: {
    type: Object,
  }
})

const form = useForm({
  name: '',
  description: '',
  location: '',
  city_id: '',
  type_id: props.type_id,
  owner_id: props.owner_id,
  images: [],
  imagesPreviewURLs: [],
});

const handelImage = (event) => {
  form.images = [];
  form.imagesPreviewURLs = [];
  for (let i = 0; i < 12; i++) {
    form.images.push(event.target.files[i]);
    const reader = new FileReader();
    reader.onload = (e) => {
      form.imagesPreviewURLs.push(e.target.result);
    };
    reader.readAsDataURL(event.target.files[i]);
  }
};

const message = ref('');
const submit = () => {
  form.post(route('store'), {
    onSuccess: () => {
      console.log('Successfully created!');
    },
    onError: (error) => {
      message.value = error;
      setTimeout(() => {
        message.value = '';
      }, 8000);

    }
  });

};
</script>

<template>
  <button @click="router.post(route('owner.logout'))"
    class="fixed  bg-black text-white py-2 duration-200 rounded  mt-3 flex right-5 hover:shadow-none hover:translate-y-1 shadow-lg px-4">
    Logout
  </button>
  <div class="flex justify-center bg-gray-100 items-center  h-screen">
    <div class="max-w-2xl w-full bg-white p-8 border">
      <form @submit.prevent="submit" class="space-y-4">
        <h2 class="text-xl font-bold text-center">Create your business informations</h2>
        <div>
          <p v-if="message" class="text-red-500 text-md text-center opacity-100">
            The images field must be a file of type: jpg, jpeg, png.
            {{ message }}
          </p>
          <p v-else class="text-red-500 text-md text-center opacity-0">
            The images field must be a file of type: jpg, jpeg, png.
          </p>
        </div>
        <div>
          <label for="name">Name</label>
          <TextInput type="text" id="name" v-model="form.name" />
        </div>
        <div>
          <label for="location">Location</label>
          <TextInput type="text" id="location" v-model="form.location" />
        </div>
        <div>
          <InputLabel for="type">City:</InputLabel>
          <select class="w-full rounded focus:ring-0 focus:outline-none disabled:opacity-40 focus:border-black "
            v-model="form.city_id">
            <option value="" disabled>Select City</option>
            <option v-for="(city, index) in cities" :key="index" :value="city.id">{{ city.name }}</option>
          </select>
        </div>
        <div>
          <label for="description" class="block">Description</label>
          <textarea id="description" v-model="form.description" rows="4"
            class="block w-full text-sm focus:outline-none ring-0 focus:ring-0 focus:border-black text-black bg-white rounded-lg border"
            placeholder="Write your thoughts here..."></textarea>
        </div>
        <div>
          <label>Upload images:</label>
          <div class="flex items-center justify-center">
            <label for="dropzone-file"
              class="flex flex-col items-center justify-center w-full h-32 border-2 border-black border-dashed rounded-lg cursor-pointer">
              <div v-if="form.imagesPreviewURLs.length == 0"
                class="flex flex-col items-center justify-center pt-5 pb-6">
                <img src="@/Components/icons/upload.svg" class="w-8 h-8 mb-4" />
                <p class="mb-2 mx-3 text-sm text-black"><span class="font-semibold">Click to upload images of your
                    Store</span> or drag and drop</p>
              </div>
              <div class="mx-2" v-if="form.imagesPreviewURLs.length > 0">
                <div class="grid grid-cols-6 gap-1 w-full">
                  <div v-for="(images, index) in form.imagesPreviewURLs" :key="index">
                    <img :src="images" alt="Uploaded Image" class="rounded w-28 h-12">
                  </div>
                </div>
              </div>
              <input id="dropzone-file" type="file" name="images[]" class="hidden" multiple @change="handelImage" />
            </label>
          </div>
        </div>
        <div>
          <PrimaryButton type="submit" :disabled="form.processing">Create</PrimaryButton>
        </div>
      </form>
    </div>
  </div>
  <Footer />
</template>