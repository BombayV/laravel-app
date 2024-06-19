<script setup lang="ts">
import InfoCard from '@/components/InfoCard.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Chart from 'chart.js/auto';
import { onMounted, ref } from 'vue';

const props = defineProps<{
	stats: {
		clients: any[];
		orders: any[];
		products: number;
		productTypes: number;
	};
}>();
const chart = ref<HTMLCanvasElement | null>(null);

onMounted(() => {
	const newestDate = new Date();
	const oldestDate = new Date(newestDate);
	oldestDate.setDate(oldestDate.getDate() - 30);

	const clientCountPerDay = props.stats.clients.reduce((acc, client) => {
		const date = new Date(client.created_at).toLocaleDateString();
		acc[date] = acc[date] ? acc[date] + 1 : 1;
		return acc;
	}, {});
	const orderCountPerDay = props.stats.orders.reduce((acc, order) => {
		const date = new Date(order.ped_fec).toLocaleDateString();
		acc[date] = acc[date] ? acc[date] + 1 : 1;
		return acc;
	}, {});

	new Chart(chart.value!, {
		type: 'line',
		data: {
			labels: Array.from({ length: 15 }, (_, i) => {
				// Every 2 days
				const date = new Date(oldestDate);
				date.setDate(date.getDate() + i * 2);
				return date.toLocaleDateString();
			}),
			datasets: [
				{
					label: 'Clientes',
					data: clientCountPerDay,
					backgroundColor: 'rgba(54, 162, 235, 0.2)',
					borderColor: 'rgba(54, 162, 235, 1)',
					borderWidth: 1,
					tension: 0.1
				},
				{
					label: 'Pedidos',
					data: orderCountPerDay,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255, 99, 132, 1)',
					borderWidth: 1,
					tension: 0.1
				}
			]
		},
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
});
</script>

<template>
	<Head title="Reportes" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="text-xl font-semibold leading-tight text-gray-800">Reportes</h2>
		</template>
		<div class="px-4 py-12">
			<div class="mx-auto flex max-w-7xl flex-col gap-y-4 sm:px-6 lg:px-8">
				<div class="grid grid-cols-3 gap-4">
					<InfoCard
						title="Clientes creados"
						subtitle="Ultimos 30 dias"
						:mainValue="stats.clients.length"
					/>
					<InfoCard
						title="Productos creados"
						subtitle="Ultimos 30 dias"
						:mainValue="stats.products"
					/>
					<InfoCard title="Tipos de productos" subtitle="Total" :mainValue="stats.productTypes" />
				</div>
				<div class="relative mt-8 w-full">
					<canvas ref="chart"></canvas>
				</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
