<script setup lang="ts">
import { SalesColumn } from '@/components/table/columns';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps<{
  data?: any;
  result?: SalesColumn;
}>();
</script>

<template>
  <Head title="Reportes" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Reportes</h2>
    </template>
    <div class="px-4 py-12">
      <div class="mx-auto flex max-w-7xl flex-col gap-y-4 sm:px-6 lg:px-8">

      </div>
    </div>
  </AuthenticatedLayout>
</template>
