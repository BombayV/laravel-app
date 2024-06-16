<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
	inventory_count?: any;
	last_30_days_entries?: any;
	last_30_days_exits?: any;
}>();

const inventoryCount = ref(props.inventory_count);
const last30DaysEntries = ref(props.last_30_days_entries);
const last30DaysExits = ref(props.last_30_days_exits);

const numberFormat = (num: number) => {
	if (num > 999 && num < 1000000) {
		return (num / 1000).toFixed(1) + 'K';
	} else if (num > 1000000) {
		return (num / 1000000).toFixed(1) + 'M';
	} else if (num < 900) {
		return num;
	}
};
</script>

<template>
	<Head title="Dashboard" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
		</template>

		<div class="py-12">
			<div class="mx-auto flex max-w-7xl flex-col gap-y-4 sm:px-6 lg:px-8">
				<div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
					<div class="p-6 text-gray-900">You're logged in!</div>
				</div>
				<div class="grid grid-cols-3 gap-4">
					<div class="flex flex-col items-center gap-y-2 space-x-4 rounded-md border bg-white p-4">
						<div class="flex-1 space-y-1">
							<p class="text-center text-2xl font-semibold leading-none">Productos Totales</p>
							<p class="text-center text-sm text-muted-foreground">Numero de productos creados</p>
						</div>
						<p class="text-5xl font-semibold leading-none">
							{{ numberFormat(inventoryCount) }}
						</p>
					</div>
					<div class="flex flex-col items-center gap-y-2 space-x-4 rounded-md border bg-white p-4">
						<div class="flex-1 space-y-1">
							<p class="text-center text-2xl font-semibold leading-none">Entradas</p>
							<p class="text-center text-sm text-muted-foreground">En los ultimos 30 dias</p>
						</div>
						<p class="text-5xl font-semibold leading-none">
							{{ numberFormat(last30DaysEntries) }}
						</p>
					</div>
					<div class="flex flex-col items-center gap-y-2 space-x-4 rounded-md border bg-white p-4">
						<div class="flex-1 space-y-1">
							<p class="text-center text-2xl font-semibold leading-none">Salidas</p>
							<p class="text-center text-sm text-muted-foreground">En los ultimos 30 dias</p>
						</div>
						<p class="text-5xl font-semibold leading-none">
							{{ numberFormat(last30DaysExits) }}
						</p>
					</div>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
