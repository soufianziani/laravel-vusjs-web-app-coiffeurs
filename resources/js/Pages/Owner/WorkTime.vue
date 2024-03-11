<script setup>
import { useForm } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


const props = defineProps({
  store_id: {
    type: Number,
    required: true
  },
})

const form = useForm({
  day: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
  start_time: [],
  end_time: [],
  status: [], 
  store_id:props.store_id,

});

const checked = ref([]);

function toggleCheckbox(day, index) {
  const isChecked = checked.value.includes(day);
  if (!isChecked) {
    checked.value.push(day);
  } else {
    checked.value.splice(checked.value.indexOf(day), 1);
  }

  // Update status based on checkbox
  form.status[index] = isChecked ? 'open' : 'closed';
}

function isDisabled(day) {
  return checked.value.includes(day);
}

function submitForm() {
  form.post(route('worktime.store'), {
    onError(error) {
      console.log(error)
    },
    onSuccess: () => {
      console.log('Work time data saved successfully!');
    }
  });
}
</script>

<template>
  <div>
    <!-- Your logout button -->
    <div class="flex justify-center bg-gray-100 items-center h-screen">
      <div class="max-w-2xl w-full bg-white p-8 border">
        <h1 class="text-2xl font-bold text-center mb-6">Select your work time</h1>
        <form @submit.prevent="submitForm">
          <div v-for="(day, index) in weekdays" :key="index" class="flex items-center w-full mb-5 gap-2">
            <div class="flex items-center gap-2">
              <label class="flex items-center">
                <Checkbox :checked="checked.includes(day)" @click="toggleCheckbox(day, index)" />
                <span class="ms-2 text-sm text-Study_black">closed</span>
              </label>
              <div class="border p-4 w-36 rounded">
                <p class="text-xl font-semibold">{{ day }}</p>
              </div>
            </div>
            <div class="flex gap-2 w-full">
              <div class="w-full">
                <p class="text-center">Start</p>
                <TextInput :disabled="isDisabled(day)" type="time" v-model="form.start_time[index]" />
              </div>
              <div class="w-full">
                <p class="text-center">End</p>
                <TextInput :disabled="isDisabled(day)" type="time" v-model="form.end_time[index]" />
              </div>
            </div>
          </div>
          <PrimaryButton class="mt-4" type="submit">Create</PrimaryButton>
        </form>
      </div>
    </div>
    <Footer />
  </div>
</template>
