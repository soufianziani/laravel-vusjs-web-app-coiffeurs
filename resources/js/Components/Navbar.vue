<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { router } from '@inertiajs/vue3';

const showMenu = ref(false);
const scrolled = ref(false);

const handleScroll = () => {
  scrolled.value = window.scrollY > 0;
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>

<template>
  <div class="fixed top-0 z-10 w-full" :class="{ 'bg-white ': scrolled }">
    <div class="md:bg-transparent bg-white">
      <nav class="container px-6 py-4 mx-auto gap-4 md:flex md:justify-between lg:items-center">
        <div class="flex items-center justify-between">
          <div @click="router.get(route('home'))" :class="scrolled ? 'text-black' : 'md:text-white'"
            class="text-xl cursor-pointer font-bold  md:text-2xl">Logo</div>
          <div @click="showMenu = !showMenu" class="flex md:hidden">
            <img src="./icons/close.svg" v-if="showMenu" class="w-6" alt="close">
            <img src="./icons/menu.svg" v-if="!showMenu" class="w-6" alt="menu">
          </div>
        </div>

        <ul :class="showMenu ? 'flex' : 'hidden', scrolled ? 'text-black ' : 'md:text-white'"
          class="flex-col mt-8 gap-y-4 md:flex md:gap-0 md:flex-row md:items-center md:gap-x-10 md:mt-0">
          <li class="cursor-pointer hover:underline-offset-1 hover:underline">Coiffeur</li>
          <li class="cursor-pointer hover:underline-offset-1 hover:underline">Barbier</li>
          <li class="cursor-pointer hover:underline-offset-1 hover:underline">Manucure</li>
          <li class="cursor-pointer hover:underline-offset-1 hover:underline">Institut de beauté</li>
          <button @click="router.get(route('register'))"
            class=" text-black hover:bg-opacity-70 bg-gray-200 px-3 py-2 rounded-md">
            Ajoutez votre établissement
          </button>
          <button @click="router.get(route('login'))"
            class=" text-white hover:bg-opacity-80 bg-black px-3 py-2 rounded-md">
            Login 
          </button>
        </ul>
      </nav>
    </div>
  </div>
</template>