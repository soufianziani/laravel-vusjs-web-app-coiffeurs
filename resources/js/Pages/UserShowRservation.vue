<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    reservation: {
        type: Object
    },
    services: {
        type: Array
    },
    totalDuration: {
        type: Number
    },
    totalPrice: {
        type: Number
    }
})

const displayDuration = (duration) => {
    if (duration >= 60) {
        const hours = Math.floor(duration / 60);
        const minutes = duration % 60;
        if (minutes === 0) {
            return `${hours} h`;
        } else {
            return `${hours}h ${minutes}min`;
        }
    } else {
        const durationString = duration.toString();
        if (durationString.endsWith('.00')) {
            return `${durationString.slice(0, -3)} min`; // Remove the ".00"
        } else {
            return `${duration} min`;
        }
    }
}

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

const statusClass = computed(() => {
    switch (props.reservation.status) {
        case 'pending':
            return 'bg-yellow-100 text-yellow-800 font-medium me-2 px-2.5 py-1 rounded-full';
        case 'rejected':
            return 'bg-red-100 text-red-800 font-medium me-2 px-2.5 py-1 rounded-full';
        case 'accepted':
            return 'bg-green-100 text-green-800 font-medium me-2 px-2.5 py-1 rounded-full';
        default:
            return '';
    }
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Your Reservations</h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:mt-10">
            <button class="flex items-center mb-5 gap-1" @click="router.get(route('user.dashboard'))">
                <img src="@/Components/icons/back.svg" class="w-7 h-7" />
                <p class="font-bold">Back</p>
            </button>
            <div class="bg-white p-5 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex sm:flex-row flex-col gap-3 justify-between">
                    <div>
                        <p>Date Reservation : <span class="font-semibold">{{ formatDate(reservation.created_at)
                                }}</span></p>
                        <p>Store Name : <span class="font-semibold">{{ reservation.store.name }}</span></p>
                    </div>
                    <p>Status : <span :class="statusClass">{{ reservation.status }}</span></p>
                </div>
                <div class="overflow-x-auto pt-20">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Service</th>
                                <th class="px-4 py-2">Category</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center" v-for="(service, index) in services" :key="service.id">
                                <td class="border py-2">{{ index + 1 }}</td>
                                <td class="border py-2">{{ service.name }}</td>
                                <td class="border py-2">{{ service.category?.name ?? '-' }}</td>
                                <td class="border py-2">{{ service.price }}$</td>
                                <td class="border py-2">{{ displayDuration(service.duration) }}</td>
                            </tr>
                            <!-- Add a row for displaying total duration and total price -->
                            <tr>
                                <td colspan="3" class=" border bg-gray-100 px-4 py-2">Total</td>
                                <td colspan="1" class="border text-center px-4 py-2">{{ totalPrice }} $</td>
                                <td colspan="1" class="border text-center px-4 py-2">{{ displayDuration(totalDuration)
                                    }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </=>
    </AuthenticatedLayout>
</template>
