<script setup>
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';
import Section from '@/Components/Section.vue';
import Stats from '@/Components/Stats.vue'
import StoresList from '@/Components/StoresList.vue'

const props=defineProps({
  types:{
    type:Array,
  },
  cities:{
    type:Array,
  }
})


</script>
<template>
<div class="bg-white">
  <Navbar />
    <div class="bg-[url('@/Components/images/3.jpg')] w-full min-h-screen bg-center bg-cover flex justify-center items-center">
      <div class="w-full  max-w-[900px] mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-[300%] font-bold text-white ">Réservez un Beauté</h1>
        <span class="text-white">Simple • Immédiat • 24h/24</span>
        <div class="flex items-center justify-center mt-4">
          <div class=" flex space-x-2 justify-between border rounded-lg bg-white w-full">
            <div class="flex w-full py-3 px-3 space-x-2">
              <label for="UserEmail" class=" overflow-hidden rounded-md w-full text-left px-3  focus-within:border-black focus-within:ring-black">
                <span class="text-xs font-medium text-gray-500"> Que cherchez-vous ? </span>
                <input type="email" id="UserEmail" placeholder="Nom du salon, prestations (coupe...) " class="mt-1 w-full border-none p-0 focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm" />
              </label>
              <div class="border-r lg:block hidden border"></div>
              <label for="UserEmail" class=" lg:block hidden overflow-hidden rounded-md w-full text-left px-3  focus-within:border-black focus-within:ring-black">
                <span class="text-xs font-medium text-gray-500"> Où </span>
                <input type="email" id="UserEmail" placeholder="Adresse, ville..." class="mt-1 w-full border-none p-0 focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm" />
              </label>
              <button class="bg-black py-2 px-4 mx-2 text-white rounded">
                  <p class="sm:block hidden">Rechercher</p>
                  <img src="@/Components/icons/search.svg" class="sm:hidden  w-6" alt="">
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Stats/>
    <Section/>
    <StoresList :types="types" :cities="cities"/>
    <Footer/>
</div>
  </template>
  
