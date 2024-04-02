<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    reservations:{
        type:Array,
    }
})

const formatDate = (timestamp) => {
    const date = new Date(timestamp);
    const formattedDate = `${date.getDate()}-${date.getMonth() + 1}-${date.getFullYear()}`;
    let hours = date.getHours();
    const minutes = date.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    const formattedTime = `${hours}:${minutes < 10 ? '0' + minutes : minutes} ${ampm}`;
    return `${formattedDate} - ${formattedTime}`;
};

const download = () =>{
    axios.get(route('user.download'), 
        { headers: { responseType: 'blob' } }
    )
    .then(({ data }) => {
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(new Blob([data]));
        link.setAttribute('download', 'event.ics');
        document.body.appendChild(link);
        link.click();
    })
}
const statusClass = (status) => {
    switch (status) {
        case 'pending':
            return 'bg-yellow-100 text-yellow-800 mx-2 rounded-full';
        case 'rejected':
            return 'bg-red-100 text-red-800 mx-2 rounded-full';
        case 'accepted':
            return 'bg-green-100 text-green-800 mx-2 rounded-full';
        default:
            return '';
    }
};
const show = (res) => {
    console.log(res);
    router.get(route('user.show' , { 'id': res }));
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Your Reservations</h2>
        </template>

        
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:mt-10">
                <div class="bg-white p-5 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table-auto  w-full">
                    <tr>
                        <th class="py-2">#</th>
                        <th class="py-2">Store Name</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Reservation Date</th>
                        <th class="py-2">Action</th>
                    </tr>
                    <tr class="text-center"v-for="reservation,index in reservations" :key="reservation.id">
                        <td class="border py-4 px-2">{{ index+1 }}</td>
                        <td class="border py-4">{{ reservation.store.name}}</td>
                        <td class="border py-4"><p :class="statusClass(reservation.status)">{{ reservation.status}}</p></td>
                        <td class="border py-4">{{ formatDate(reservation.created_at)}}</td>
                        <td class="border py-4">
                            <div class="flex justify-center items-center">
                                <button @click="show(reservation.id)"class=" text-blue-500 underline px-3 cursor-pointer hover:opacity-80 rounded">show</button>
                                <button @click="download" class=" text-blue-500 underline px-3 cursor-pointer hover:opacity-80 rounded">Download</button>
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        </=>
    </AuthenticatedLayout>
</template>
