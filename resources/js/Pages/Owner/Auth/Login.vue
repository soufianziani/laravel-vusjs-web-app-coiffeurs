<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, router, usePage } from '@inertiajs/vue3';

const props = defineProps({
    canResetPassword: Boolean,
    errors: {
        type: Object,
    },
});

const showMessage = ref(true);

const hideMessage = () => {
    showMessage.value = false;
}

const message = usePage().props.message;

if (message) {
    setTimeout(hideMessage, 1000);
}

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

        <Head title="owner" />
        <form @submit.prevent="submit">
            <div v-if="showMessage && props.errors?.message"
                class="mb-4 flex justify-between items-center bg-red-200 p-5 mt-2 text-sm font-medium text-center text-red-600">
                {{ props.errors.message }}
                <img src="@/Components/icons/close.svg" class="cursor-pointer w-[13px]" alt="close" @click="hideMessage">
            </div>

            <div v-if="resetPasswordSuccessMessage" class="text-center mt-3 text-green-500">
                {{ resetPasswordSuccessMessage }}
            </div>
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                    autocomplete="username" />
                <p class="text-red-600">{{ form.errors.email }}</p>
            </div>
            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="current-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="mt-4 flex justify-between">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-black">Remember me</span>
                </label>
                <div @click="reset_password" class="underline text-sm cursor-pointer text-black hover:font-bold">
                    Forgot your password?
                </div>
            </div>
            <div class="flex items-center justify-end mt-5">
                <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Login
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout></template>

