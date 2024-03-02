<script setup>

const props= defineProps({
    disabled:{
        type:Boolean
    }
})
</script>
<template>
    <button
        :desabled="desabled"
        class="bg-black rounded w-full py-2 text-white hover:bg-opacity-95 px-4"
    >
        <slot />
    </button>
</template>
