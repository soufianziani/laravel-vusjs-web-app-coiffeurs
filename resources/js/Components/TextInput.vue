<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const props = defineProps({
    placeholder:{
        type:String
    },
    required:{
        type:Boolean,
        default:true
    }
})

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
    class="bg-white rounded disabled:border-gray-300 disabled:text-gray-300 focus:outline-none ring-0 focus:ring-0 border focus:border-black w-full shadow-sm "
        v-model="model"
        ref="input"
        :placeholder="placeholder"
        :required="required"
    />
</template>
