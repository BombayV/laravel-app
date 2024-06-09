<script setup lang="ts">
import ApplicationLogo from '@/components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import Toaster from '@/components/ui/toast/Toaster.vue'
</script>

<template>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 px-8 md:px-0">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
    <Toaster :duration="5000" />
</template>
