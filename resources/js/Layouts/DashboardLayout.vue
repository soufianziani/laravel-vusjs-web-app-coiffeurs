<script setup>
import Sidebar from '@/Components/Sidebar.vue'

const props = defineProps({
    ownerDash:{
        type:String,
        
    }
})

</script>
<template>

    <Sidebar :owner="ownerDash" />

    <div class="p-4 sm:mt-12 mt-14 md:ml-64">
        <slot name="content"/>
        
    </div>
</template>