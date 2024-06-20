<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps<{}>();

const form = useForm({

});

const test = () => {
  console.log('test');

  form.post(route('facturas.generate'), {
    onSuccess: () => {
      console.log('success');
    },
    onError: () => {
      console.log('error');
    }
  })
};
</script>

<template>
	<Head title="Facturas" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="text-xl font-semibold leading-tight text-gray-800">Facturas</h2>
		</template>
		<div class="px-4 py-12">
			<div class="mx-auto flex max-w-7xl flex-col gap-y-4 sm:px-6 lg:px-8">
        <button
          @click="test"
          >
          Test
        </button>
      </div>
		</div>
	</AuthenticatedLayout>
</template>
