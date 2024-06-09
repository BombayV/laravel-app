<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import { Checkbox } from "@/components/ui/checkbox";
import { useToast } from '@/components/ui/toast/use-toast'
import {watch} from "vue";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};

const { toast } = useToast();

watch(() => form.errors, (value) => {
    if (value) {
        toast({
            title: 'Uh oh! Something went wrong.',
            description: 'Please check your credentials and try again.',
            variant: 'destructive',
        })
    }
});
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <form @submit.prevent="submit" class="flex flex-col items-center justify-center gap-y-4">
            <div class="grid w-full max-w-sm items-center gap-1.5">
                <Label for="email">Email</Label>
                <Input id="email" type="email" placeholder="Email" v-model="form.email" required autofocus autocomplete="username" />
            </div>
            <div class="grid w-full max-w-sm items-center gap-1.5">
                <Label for="password">Password</Label>
                <Input id="email" type="password" placeholder="Password" v-model="form.password" required autocomplete="current-password" />
            </div>
            <div class="flex items-center justify-between w-full relative px-2">
                <div class="items-center flex space-x-2">
                    <Checkbox id="remember" v-model:checked="form.remember"/>
                    <label
                        for="remember"
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                    >
                        Recuerdame
                    </label>
                </div>
                <Button type="submit" class="w-full max-w-32">
                    Log in
                </Button>
            </div>
        </form>
    </GuestLayout>
</template>
