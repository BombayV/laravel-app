<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InfoCard from '@/components/InfoCard.vue';

defineProps<{
  stats: {
    clients: number;
    products: number;
    productTypes: number;
  }
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
        {{ stats.clients }}
        <div class="grid grid-cols-3 gap-4">
          <InfoCard
            title="Clientes creados"
            subtitle="Ultimos 30 dias"
            :mainValue="stats.clients"
          />
          <InfoCard
            title="Productos creados"
            subtitle="Ultimos 30 dias"
            :mainValue="stats.products"
          />
          <InfoCard
            title="Tipos de productos"
            subtitle="Total"
            :mainValue="stats.productTypes"
          />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
