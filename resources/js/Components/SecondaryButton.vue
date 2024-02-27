<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="border border-black rounded w-full py-2 text-black hover:text-white hover:bg-black px-4"
    >
        <slot />
    </button>
</template>
