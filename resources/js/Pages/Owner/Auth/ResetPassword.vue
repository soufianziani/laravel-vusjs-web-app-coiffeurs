<script setup>
import { Head, useForm} from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {router} from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
    errors: {
        type: Object,
    },
});
                         
const form = useForm({
    email: props.email,
    token: props.token,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('admin.password.update'));
};const goBackHandler = () => {
    router.get(route('login'));
};
</script>

<template>
    <GuestLayout showGoBack="true" :goBackHandler="goBackHandler">
        <Head title="Reset Password" />
        <h1 class="text-center text-4xl  font-black  text-black ">Reset Account password</h1>

        <form @submit.prevent="submit">
           
            <div class="mt-4">
                <InputLabel for="password" value=" New password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reset Password
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>