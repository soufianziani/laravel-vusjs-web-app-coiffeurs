<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    reservation: {
        type: Array // the reservation is : id , status {pending , accepted , rejected} , user_id , store_id , created_at , updated_at
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
console.log(props.reservation);

const setSelectedReservation = (res) => {
    router.get(route('reservation.show', { 'id': res }))
}


const handelchange = (reservationId, newStatus) => {
    console.log(reservationId, newStatus);
    router.post(route('reservation.updateStatus', { id: reservationId }), { status: newStatus })
}


</script>
<template>
    <DashboardLayout>
        <template #content>
            <div class="overflow-x-auto">
                <h1 class="text-2xl text-center mt-5 mb-10 font-semibold ">Store Rservations </h1>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Store</th>
                            <th class="px-4 py-2">Date Reservation</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="reservation.length">
                            <tr v-for="(res, index) in reservation" :key="res.id">
                                <td class="border text-center px-4 py-2">{{ index + 1 }}</td>
                                <td v-if="res.status == 'pending'" class="border text-center px-4 py-2"> <span
                                        class="bg-yellow-100 text-yellow-800   font-medium me-2 px-2.5 py-0.5 rounded">{{
                            res.status }}</span> </td>
                                <td v-if="res.status == 'accepted'" class="border text-center px-4 py-2"> <span
                                        class="bg-green-100 text-green-800   font-medium me-2 px-2.5 py-0.5 rounded">{{
                            res.status }}</span> </td>
                                <td v-if="res.status == 'rejected'" class="border text-center px-4 py-2"> <span
                                        class="bg-red-100 text-red-800   font-medium me-2 px-2.5 py-0.5 rounded">{{
                            res.status }}</span> </td>
                                <td class="border text-center px-4 py-2">{{ res.user.name }}</td>
                                <td class="border text-center px-4 py-2">{{ res.store.name }}</td>
                                <td class="border text-center px-4 py-2">{{ formatDate(res.created_at) }}</td>
                                <td class="border text-center px-4 py-2  ">
                                    <button @click="setSelectedReservation(res.id)"
                                        class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 mx-1 rounded">
                                        View Details
                                    </button>
                                    <button v-if="res.status == 'pending' || res.status == 'rejected'"
                                        @click="handelchange(res.id, 'accepted')"
                                        class="bg-green-100 hover:bg-green-500 hover:text-white text-green-700 font-bold py-2 px-4 mx-1 rounded">
                                        Accept
                                    </button>

                                    <button v-if="res.status == 'pending' || res.status == 'accepted'"
                                        @click="handelchange(res.id, 'rejected')"
                                        class="bg-red-100 hover:bg-red-500 hover:text-white text-red-700 font-bold py-2 px-4 mx-1 rounded">
                                        Reject
                                    </button>

                                    <button v-if="res.status == 'rejected' || res.status == 'accepted'"
                                        @click="handelchange(res.id, 'pending')"
                                        class="bg-yellow-100 hover:bg-yellow-500 hover:text-white text-yellow-700 font-bold py-2 px-4 mx-1 rounded">
                                        Mark as Pending
                                    </button>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <tr>
                                <td class="border px-4 py-5 text-center" colspan="7">No reservations found.</td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </template>

    </DashboardLayout>
</template>