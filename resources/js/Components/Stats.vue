  <script setup>
       const  stats = [
          { data: '35K', title: 'Customers' },
          { data: '10K+', title: 'Downloads' },
          { data: '40+', title: 'Countries' },
          { data: '30M+', title: 'Total revenue' }
        ]
 
  </script>
<template>
    <section class="py-14">
      <div class="mx-auto px-4 text-gray-600 gap-x-12 items-start justify-between">
        <div class="mt-6 gap-12 sm:mt-0 flex flex-col justify-between sm:flex-row ">
         <div class="max-w-md">
          <h3 class="text-black text-3xl font-semibold sm:text-4xl">
            We do our best to make customers always happy
          </h3>
          <p class="mt-3 ">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi venenatis sollicitudin quam ut tincidunt.
          </p>
         </div>
          <ul class="grid gap-y-8 gap-x-14 grid-cols-2">
            <li v-for="(item, idx) in stats" :key="idx">
              <h4 class="text-4xl text-black font-semibold">{{ item.data }}</h4>
              <p class="mt-3 font-medium">{{ item.title }}</p>
            </li>
          </ul>
        </div>
      </div>
    </section>
  </template>
  