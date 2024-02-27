<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <div class="md:w-1/2 w-full flex justify-center">
            <div class="md:w-1/2 min-w-[400px] w-full mx-3">
                <div class="mb-4 text-3xl font-bold text-center text-black">
                    Sign up
                </div>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                            autocomplete="name" />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                            autocomplete="new-password" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />

                        <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                            v-model="form.password_confirmation" required autocomplete="new-password" />

                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                    <div>
                        <span class="flex items-center mt-5">
                            <span class="h-px flex-1 bg-gray-300"></span>
                            <span class="shrink-0 px-6">or</span>
                            <span class="h-px flex-1 bg-gray-300"></span>
                        </span>
                        <p class="text-black text-center mt-4 text-xl">Already have an account?</p>
                        <SecondaryButton 
                        @click="router.get(route('login'))"
                        class="mt-4" >
                        Login
                    </SecondaryButton>
                    </div>
                </form>
            </div>
        </div>
        <template #background>
            <div class=" md:block hidden  w-1/2">
                <img src="@/Components/images/3.jpg" class="min-h-screen object-cover object-center" alt="">
            </div>
        </template>
    </GuestLayout>
</template>
