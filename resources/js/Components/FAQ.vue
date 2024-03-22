<template>
   <div class="bg-gray-50">
    <div class=" border-b duration-200 ">
        <div class="flex flex-col mb-20">
            <h1 class="text-3xl text-center my-20">Frequently Asked Questions</h1>
            <div v-for="i in [1,2,3,4,5]" :key="i" class="mx-auto ">
        <details class="group max-w-[900px] mb-5 [&_summary::-webkit-details-marker]:hidden" close>
          <summary class="flex lg:w-[900px] md:w-[700px] cursor-pointer items-center justify-between gap-5 p-4 text-gray-900">
            <h2 class="font-medium text-xl">Lorem ipsum dolor sit amet consectetur adipisicing?</h2>
            <div>
              <svg
                class="size-5 shrink-0 transition duration-300 group-open:-rotate-180"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
          </summary>
          <p class="mb-4 px-4 leading-relaxed text-gray-700">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab hic veritatis molestias culpa in, recusandae laboriosam neque aliquid libero nesciunt voluptate dicta quo officiis explicabo consequuntur distinctio corporis earum similique!
          </p>
        </details>
        <hr v-if="i<5" class="mb-5"> <!-- Horizontal line inside the loop, after each question -->
      </div>
        </div>
    </div>
   </div>
  </template>
  