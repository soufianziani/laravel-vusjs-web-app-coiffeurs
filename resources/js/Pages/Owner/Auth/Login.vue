<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, router, usePage } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    canResetPassword: Boolean,
    errors: {
        type: Object,
    },
});
console.log(props.errors)

const form = useForm({
    email: '',
    password: '',
    remember: true,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember,
    })).post(route('owner.login.authenticate'), {
        onFinish: () => form.reset('password'),
        onError: (error) => {
            // Set error message for email or password field
            if (error.email) {
                form.errors.email = error.email;
            }
            if (error.password) {
                form.errors.password = error.password;
            }
        },
    });
};

const resetPasswordSuccessMessage = ref('');
const reset_password = () => {
    if (!form.email)
        form.errors.email = "The email field is required.";

    router.post(route('owner.password.send'),
        { email: form.email },
        {
            onSuccess: () => {
                resetPasswordSuccessMessage.value = `The reset has been send in your email`;
                setTimeout(() => {
                    resetPasswordSuccessMessage.value = '';
                }, 10000);
            },
            onError: (error) => {
                form.errors.email = error.email;
                setTimeout(() => {
                    form.errors.email = '';
                }, 5000);
            },
        });
};

</script>
<template>
    <GuestLayout >

        <Head title="Login " />
        <div class="md:w-1/2 w-full flex justify-center">
            <div class="md:w-1/2 min-w-[400px]  w-full mx-3">
                <div class="mb-4 text-3xl font-bold text-center text-black">
            Login for Owner
        </div>
                <div div v-if="errors"
                    class="text-center text-red-600">
                    <p> {{ errors.message }}</p>

                </div>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                            autocomplete="username" />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />

                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                            autocomplete="current-password" />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mt-4 flex justify-between ">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ms-2 text-sm text-Study_black">Remember me</span>
                        </label>
                        <div v-if="canResetPassword" @click="router.get(route('password.request'))"
                            class="underline text-sm cursor-pointer text-Study_black hover:font-bold">
                            Forgot your password?
                        </div>
                    </div>

                    <PrimaryButton class="w-full mt-5" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Login
                        </PrimaryButton>
                        <div>
                        <span class="flex items-center mt-5">
                            <span class="h-px flex-1 bg-gray-300"></span>
                            <span class="shrink-0 px-6">or</span>
                            <span class="h-px flex-1 bg-gray-300"></span>
                        </span>
                        <p class="text-black text-center mt-4 text-xl">Don't have an account?</p>
                        <SecondaryButton 
                        @click="router.get(route('owner.register'))"
                        class="mt-4" >
                        Sign up 
                    </SecondaryButton>
                    </div>

                </form>
            </div>
        </div>
        <template #background>
            <div class=" md:block hidden  w-1/2">
                <img src="@/Components/images/1.jpg" class="min-h-screen object-cover object-center" alt="">
            </div>
        </template>
    </GuestLayout>
</template>
