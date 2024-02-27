<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

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
    class="bg-white rounded focus:outline-none ring-0 focus:ring-0 border focus:border-black w-full shadow-sm sm:text-sm"
        v-model="model"
        ref="input"
    />
</template>
