<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  owner: {
    type: String ,
    
  }
})

console.log(props.owner);

const isSidebarOpen = ref(false);
const isUserDropdownOpen = ref(false);
const openSettings = ref(true);

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};
const toggleDropdown = () => {
  isUserDropdownOpen.value = !isUserDropdownOpen.value;
};
const settingsToggle = () => {
  openSettings.value = !openSettings.value;
};
const selectMenuItem = (routeName) => {
  if(routeName == 'owner.logout'){

    router.post(route(routeName));
  }
 else{
  router.get(route(routeName));
 }
};

</script>

<template>

  <!-- navbar -->
  <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200  ">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <button @click="toggleSidebar" type="button"
            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
              </path>
            </svg>
          </button>
          <p class="flex ms-2 font-bold text-xl md:me-24">
            Logo
          </p>
        </div>
        <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" @click="toggleDropdown"
                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 " aria-expanded="true"
                data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                  alt="user photo">
              </button>
            </div>
            <div v-show="isUserDropdownOpen"
              class="z-10 fixed top-10 border right-4 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow "
              id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 " role="none">
                  Neil Sims
                </p>
                <p class="text-sm font-medium text-gray-900 truncate " role="none">
                  neil.sims@flowbite.com
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-black hover:bg-gray-100 "
                    role="menuitem">Dashboard</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-black hover:bg-gray-100 " role="menuitem">Settings</a>
                </li>
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-black hover:bg-gray-100   " role="menuitem">Sign
                    out</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- sidebar -->
  <aside :class="{ 'translate-x-0': isSidebarOpen, '-translate-x-full': !isSidebarOpen }" id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0  "
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white ">
      <ul class="space-y-2 font-medium">
        <li>
          <button @click="selectMenuItem('dashboard')"
            :class="route().current() === 'dashboard' ? 'bg-gray-100 text-gray-900' : ''"
            class="flex items-center p-2 text-gray-500 w-full hover:text-gray-700 rounded-lg  hover:bg-gray-100  group">
            <svg class="w-5 h-5 text-gray-500 transition duration-75  group-hover:text-gray-700 " aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
              <path
                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
              <path
                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
            </svg>
            <span class="ms-3">Dashboard</span>
          </button>
        </li>
        <li>
          <button
            :class="route().current() === 'store.edit' || route().current() === 'store.worktime' || route().current() === 'store.categories' || route().current() === 'store.services' ? 'text-gray-700 bg-gray-100' : ''"
            @click="settingsToggle" type="button"
            class="flex items-center w-full p-2 text-base text-gray-500 transition duration-75 rounded-lg group hover:text-gray-700 hover:bg-gray-100 "
            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
            <svg class="flex-shrink-0 w-5 h-5 fill-gray-500  transition duration-75 group-hover:fill-gray-700"
              width="225px" height="225px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M14.2788 2.15224C13.9085 2 13.439 2 12.5 2C11.561 2 11.0915 2 10.7212 2.15224C10.2274 2.35523 9.83509 2.74458 9.63056 3.23463C9.53719 3.45834 9.50065 3.7185 9.48635 4.09799C9.46534 4.65568 9.17716 5.17189 8.69017 5.45093C8.20318 5.72996 7.60864 5.71954 7.11149 5.45876C6.77318 5.2813 6.52789 5.18262 6.28599 5.15102C5.75609 5.08178 5.22018 5.22429 4.79616 5.5472C4.47814 5.78938 4.24339 6.1929 3.7739 6.99993C3.30441 7.80697 3.06967 8.21048 3.01735 8.60491C2.94758 9.1308 3.09118 9.66266 3.41655 10.0835C3.56506 10.2756 3.77377 10.437 4.0977 10.639C4.57391 10.936 4.88032 11.4419 4.88029 12C4.88026 12.5581 4.57386 13.0639 4.0977 13.3608C3.77372 13.5629 3.56497 13.7244 3.41645 13.9165C3.09108 14.3373 2.94749 14.8691 3.01725 15.395C3.06957 15.7894 3.30432 16.193 3.7738 17C4.24329 17.807 4.47804 18.2106 4.79606 18.4527C5.22008 18.7756 5.75599 18.9181 6.28589 18.8489C6.52778 18.8173 6.77305 18.7186 7.11133 18.5412C7.60852 18.2804 8.2031 18.27 8.69012 18.549C9.17714 18.8281 9.46533 19.3443 9.48635 19.9021C9.50065 20.2815 9.53719 20.5417 9.63056 20.7654C9.83509 21.2554 10.2274 21.6448 10.7212 21.8478C11.0915 22 11.561 22 12.5 22C13.439 22 13.9085 22 14.2788 21.8478C14.7726 21.6448 15.1649 21.2554 15.3694 20.7654C15.4628 20.5417 15.4994 20.2815 15.5137 19.902C15.5347 19.3443 15.8228 18.8281 16.3098 18.549C16.7968 18.2699 17.3914 18.2804 17.8886 18.5412C18.2269 18.7186 18.4721 18.8172 18.714 18.8488C19.2439 18.9181 19.7798 18.7756 20.2038 18.4527C20.5219 18.2105 20.7566 17.807 21.2261 16.9999C21.6956 16.1929 21.9303 15.7894 21.9827 15.395C22.0524 14.8691 21.9088 14.3372 21.5835 13.9164C21.4349 13.7243 21.2262 13.5628 20.9022 13.3608C20.4261 13.0639 20.1197 12.558 20.1197 11.9999C20.1197 11.4418 20.4261 10.9361 20.9022 10.6392C21.2263 10.4371 21.435 10.2757 21.5836 10.0835C21.9089 9.66273 22.0525 9.13087 21.9828 8.60497C21.9304 8.21055 21.6957 7.80703 21.2262 7C20.7567 6.19297 20.522 5.78945 20.2039 5.54727C19.7799 5.22436 19.244 5.08185 18.7141 5.15109C18.4722 5.18269 18.2269 5.28136 17.8887 5.4588C17.3915 5.71959 16.7969 5.73002 16.3099 5.45096C15.8229 5.17191 15.5347 4.65566 15.5136 4.09794C15.4993 3.71848 15.4628 3.45833 15.3694 3.23463C15.1649 2.74458 14.7726 2.35523 14.2788 2.15224ZM12.5 15C14.1695 15 15.5228 13.6569 15.5228 12C15.5228 10.3431 14.1695 9 12.5 9C10.8305 9 9.47716 10.3431 9.47716 12C9.47716 13.6569 10.8305 15 12.5 15Z">
                </path>
              </g>
            </svg>
            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Settings</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
            </svg>
          </button>
          <ul v-if="openSettings" class=" py-2 mr-10 flex flex-col gap-2">
            <li>
              <button @click="selectMenuItem('store.edit')"
                :class="route().current() === 'store.edit' ? 'bg-gray-50 text-gray-900' : ''"
                class="flex w-full  items-center p-2 text-gray-500 hover:text-gray-700 rounded-lg group hover:bg-gray-50  group">
                <span class=" ms-3 ">Store</span>
              </button>
            </li>
            <li>
              <button @click="selectMenuItem('store.worktime')"
                :class="route().current() === 'store.worktime' ? 'bg-gray-50 text-gray-900' : ''"
                class="flex w-full items-center p-2 text-gray-500 hover:text-gray-700 rounded-lg  hover:bg-gray-50  group">
                <span class=" ms-3 ">Work Time </span>
              </button>
            </li>
            <li>
              <button @click="selectMenuItem('store.categories')"
                :class="route().current() === 'store.categories' ? 'bg-gray-50  text-gray-900' : ''"
                class="flex w-full items-center p-2 text-gray-500  hover:text-gray-700 rounded-lg  hover:bg-gray-50  group">
                <span class=" ms-3 ">Ctegories</span>
              </button>
            </li>
            <li>
              <button @click="selectMenuItem('store.services')"
                :class="route().current() === 'store.services' ? 'bg-gray-50 text-gray-900' : ''"
                class="flex w-full items-center p-2 group text-gray-500 hover:text-gray-700 rounded-lg  hover:bg-gray-50  group">
                <span class=" ms-3 ">Services</span>
              </button>
            </li>
          </ul>
        </li>

        <li>
          <button @click="selectMenuItem('store.reservation')"
          :class="route().current() === 'store.reservation'||'reservation.show' ? 'bg-gray-100 text-gray-900' : ''"
            class="flex w-full items-center p-2 text-gray-500 hover:text-gray-700 rounded-lg  hover:bg-gray-100  group">
            <svg class="flex-shrink-0 w-5 h-5 fill-gray-500  transition duration-75 group-hover:fill-gray-700"
              viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  d="M8 0.5C8.82843 0.5 9.5 1.17157 9.5 2V3H14.5V2C14.5 1.17157 15.1716 0.5 16 0.5C16.8284 0.5 17.5 1.17157 17.5 2V3H19C20.6569 3 22 4.34315 22 6V8H2V6C2 4.34315 3.34315 3 5 3H6.5V2C6.5 1.17157 7.17157 0.5 8 0.5Z">
                </path>
                <path d="M2 20V10H22V20C22 21.6569 20.6569 23 19 23H5C3.34315 23 2 21.6569 2 20Z"></path>
              </g>
            </svg>
            <span class=" ms-3 ">Reservations</span>
          </button>
        </li>
        <li>
          <button @click="selectMenuItem('owner.logout')"
            class="flex w-full items-center p-2 text-gray-500 hover:text-gray-700 rounded-lg  hover:bg-gray-100  group">
            <svg class="flex-shrink-0 w-5 h-5 fill-gray-500  transition duration-75 group-hover:fill-gray-700"
              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" id="sign-out">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  d="M20.49,3.84l-6-1.5A2,2,0,0,0,12,4.28V5H10A2,2,0,0,0,8,7V8a1,1,0,0,0,2,0V7h2V17H10V16a1,1,0,0,0-2,0v1a2,2,0,0,0,2,2h2v.72a2,2,0,0,0,.77,1.57,2,2,0,0,0,1.23.43,2.12,2.12,0,0,0,.49-.06l6-1.5A2,2,0,0,0,22,18.22V5.78A2,2,0,0,0,20.49,3.84Z">
                </path>
                <path
                  d="M4.41,13H9a1,1,0,0,0,0-2H4.41l1.3-1.29A1,1,0,0,0,4.29,8.29l-3,3h0a1.15,1.15,0,0,0-.21.33.94.94,0,0,0,0,.76,1.15,1.15,0,0,0,.21.33h0l3,3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z">
                </path>
              </g>
            </svg>
            <span class=" ms-3 ">Sign out </span>
          </button>
        </li>

      </ul>
    </div>
  </aside>


</template>