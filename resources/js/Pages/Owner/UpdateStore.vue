<script setup>
import TextInput from '@/Components/TextInput.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { ref } from 'vue';

const props = defineProps({

})

const disabled = ref(true);

const toggleDisabled = () => {
    disabled.value = !disabled.value;
}

</script>
<template>
    <DashboardLayout>
        <template #content>
            <div class=" flex gap-5 justify-center m-4 items-center">
                <h1 class="text-xl font-semibold">Edit your Store</h1>
                <button @click="toggleDisabled" class="bg-black text-white px-3 py-2 rounded">
                    <div v-if="disabled" class="flex items-center gap-4">
                        <img src="@/Components/icons/edit.svg" class="w-4 h-4" alt="">
                        <p> Edit</p>
                    </div>
                    <div v-else class="flex items-center gap-4">
                        <img src="@/Components/icons/validate.svg" class="w-4 h-4" alt="">
                        <p> validate</p>
                    </div>
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="border w-full">
                    <div class="p-5  w-full">
                        <p>Store Type : </p>
                        <select :disabled="disabled"
                            class="w-full  rounded focus:ring-0 focus:outline-none disabled:opacity-40 focus:border-black ">
                            <option value="">Coiffeur</option>
                        </select>
                    </div>
                    <div class="p-5  w-full">
                        <p>Store Name : </p>
                        <TextInput :disabled="disabled" type="text" id="name" />
                    </div>
                    <div class="p-5  w-full">
                        <p>City : </p>
                        <select :disabled="disabled"
                            class="w-full  rounded focus:ring-0 focus:outline-none disabled:opacity-40 focus:border-black ">
                            <option value="">Marrakech</option>
                        </select>
                    </div>
                    <div class="p-5  w-full">
                        <p>Location : </p>
                        <TextInput :disabled="disabled" type="text" id="name" />
                    </div>
                    <div class="p-5  w-full">
                        <p>Store Description : </p>
                        <textarea :disabled="disabled" rows="4"
                            class="block w-full text-sm focus:outline-none shadow-sm disabled:border-gray-300 disabled:placeholder-gray-300 ring-0 focus:ring-0 focus:border-black text-black bg-white rounded-lg border"
                            placeholder="Write your thoughts here..."></textarea>
                    </div>
                </div>
                <div class="border w-full">
                    <div class="p-5  w-full">
                        <p>Upload Images : </p>
                        <div class="flex items-center justify-center">
                            <label for="dropzone-file"
                                :class="disabled ? 'border-gray-300 text-gray-300 ' : 'border-black text-black cursor-pointer'"
                                class="flex flex-col items-center justify-center w-full h-32 border-2  border-dashed rounded-lg ">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <img src="@/Components/icons/upload.svg" class="w-8 h-8 mb-4 "
                                        :style="disabled ? 'filter: invert(97%) sepia(2%) saturate(1592%) hue-rotate(183deg) brightness(94%) contrast(82%)' : ''" />
                                    <p class="mb-2 mx-3 text-sm "><span class="font-semibold">Click to upload images of
                                            your
                                            Store</span> or drag and drop</p>
                                </div>
                                <!-- <div class="mx-2" v-if="form.imagesPreviewURLs.length > 0">
                <div class="grid grid-cols-6 gap-1 w-full">
                  <div v-for="(images, index) in form.imagesPreviewURLs" :key="index">
                    <img :src="images" alt="Uploaded Image" class="rounded w-28 h-12">
                  </div>
                </div>
              </div> -->
                                <input :disabled="disabled" id="dropzone-file" type="file" name="images[]"
                                    class="hidden" multiple />
                            </label>
                        </div>

                    </div>
                    <div class="p-5 w-full">
                        <p>Images Preview : </p>
                        <div>
                            <div v-if="!disabled" class="h-full relative w-full  group">
                                <div
                                    class=" absolute flex h-full w-full justify-center rounded group-hover:bg-black group-hover:bg-opacity-70 text-center  ">
                                </div>
                                <div
                                    class="absolute hidden  group-hover:flex gap-10 h-full w-full items-center justify-center">
                                    <div class="  select-none cursor-pointer text-xl text-white">
                                        <img src="@/Components/icons/show.svg" class="w-10 h-10" alt="show">
                                    </div>
                                    <div class="  select-none cursor-pointer items-center text-xl text-white">
                                        <img src="@/Components/icons/delete.svg" class="w-10 h-10" alt="delete">
                                    </div>
                                </div>
                                <img src="@/Components/images/1.jpg" class="w-full rounded object-cover max-h-72  "
                                    alt="" />
                            </div>
                            <img v-if="disabled" src="@/Components/images/1.jpg"
                                class="w-full grayscale opacity-60  rounded object-cover max-h-72  " alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </DashboardLayout>
</template>