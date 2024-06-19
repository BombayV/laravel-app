<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{

}>();
</script>

<template>
  <Head title="Facturas" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Facturas</h2>
    </template>
    <div class="px-4 py-12">
      <div class="mx-auto flex max-w-7xl flex-col gap-y-4 sm:px-6 lg:px-8">

      </div>
    </div>
  </AuthenticatedLayout>
</template>
