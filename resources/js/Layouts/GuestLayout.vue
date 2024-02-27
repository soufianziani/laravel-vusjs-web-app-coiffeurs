<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Navbar class="bg-black"/>
        <div
            class="w-full flex min-h-screen items-center shadow-md overflow-hidden "
        >
            <slot />
            <slot name="background"/>
        </div>
        <Footer/>
</template>
