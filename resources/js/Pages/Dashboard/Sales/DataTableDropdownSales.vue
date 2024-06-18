<script setup lang="ts">
import { SalesColumn } from '@/components/table/columns';
import DrawerItem from '@/components/table/DrawerItem.vue';
import { Button } from '@/components/ui/button';
import {
	DropdownMenu,
	DropdownMenuContent,
	DropdownMenuLabel,
	DropdownMenuSeparator,
	DropdownMenuTrigger
} from '@/components/ui/dropdown-menu';
import { Check, DollarSign, MoreHorizontal } from 'lucide-vue-next';

const props = defineProps<{
	original: SalesColumn;
	dataRef: any;
}>();
</script>

<template>
	<DropdownMenu>
		<DropdownMenuTrigger as-child>
			<Button variant="ghost" class="h-8 w-8 p-0">
				<span class="sr-only">Abrir menu</span>
				<MoreHorizontal class="h-4 w-4" />
			</Button>
		</DropdownMenuTrigger>
		<DropdownMenuContent align="end">
			<DropdownMenuLabel>Acciones</DropdownMenuLabel>
			<!-- Ver cliente -->
			<DrawerItem
				dropdownText="Ver tipo"
				:title="original.ven_id"
				description="Detalles del tipo de producto."
			>
			</DrawerItem>

			<DropdownMenuSeparator />
		</DropdownMenuContent>
	</DropdownMenu>
</template>
