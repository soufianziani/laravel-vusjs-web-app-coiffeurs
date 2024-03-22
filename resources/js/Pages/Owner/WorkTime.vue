<script setup>
import { useForm } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

const weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


const props = defineProps({
  store_id: {
    type: Number,
    required: true
  },
  worktime: {
    type: Array
  }
})

const form = useForm({
  day: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
  start_time: [],
  end_time: [],
  status: [],
  store_id: props.store_id,

});

const checked = ref([]);

function toggleCheckbox(day, index) {
  const isChecked = checked.value.includes(day);
  if (!isChecked) {
    checked.value.push(day);
  } else {
    checked.value.splice(checked.value.indexOf(day), 1);
  }

  form.status[index] = isChecked ? 'open' : 'closed';
}
const message = ref('')

function isDisabled(day) {
  return checked.value.includes(day);
}

function submitForm() {
  form.post(route('worktime.store'), {
    onError(error) {
      console.log(error)
    },
    onSuccess: () => {
      message.value = 'Work time data saved successfully!'
      setTimeout(() => {
        message.value = '';
      }, 10000);

    }
  });
}
</script>

<template>
  <DashboardLayout>
    <template #content>
      <div class="flex justify-center items-center ">
        <div class=" w-full bg-white mt-2 ">
          <h1 class="text-2xl  font-bold text-center  my-5">Select your work time</h1>
          <p v-if="message !== ''" class="text-green-400 text-lg my-5 text-center">{{ message }}</p>
          <p v-else class="text-lg my-5 text-center invisible">&nbsp;</p>
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
      <div class=" mt-5">
        <h1 class="text-xl my-4 font-semibold">Your WorkTime :</h1>
        <div class="w-full  rounded  text-gray-600 bg-white" v-for="time, index in worktime">
          <div class="flex items-center my-3 justify-between ">
            <p :class="time.status !== 'closed' ? '' : 'font-semibold text-gray-900'">{{
            time.day }}</p>
            <div class=" ">
              <div v-if="time.status !== 'closed'" class="flex items-center gap-2">
                <p>{{ time.start_time }}</p>-
                <p>{{ time.end_time }}</p>
              </div>
              <p v-else class="font-semibold text-gray-900">Closed</p>
            </div>
          </div>
          <hr v-if="index < 6">
        </div>
      </div>
    </template>
  </DashboardLayout>
</template>
