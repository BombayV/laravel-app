<script setup lang="ts">
import {InventoryColumn} from '@/components/table/columns';
import DataTable from '@/components/table/DataTable.vue';
import { Button } from '@/components/ui/button';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { ArrowUpDown } from 'lucide-vue-next';
import { h, ref } from 'vue';
import DataTableDropdownInventory from "@/Pages/Dashboard/Inventory/DataTableDropdownInventory.vue";

const props = defineProps<{
  inventory?: any;
  inventory_count?: any;
  last_30_days_entries?: any;
  last_30_days_exits?: any;
}>();

type CustomColumnDef =
  | ColumnDef<InventoryColumn>
  | {
  name: string;
};

const inventoryCount = ref(props.inventory_count);
const last30DaysEntries = ref(props.last_30_days_entries);
const last30DaysExits = ref(props.last_30_days_exits);
const dataRef = ref(props.inventory);
const CLIENTS_COLUMNS: CustomColumnDef[] = [
  {
    id: 'producto.pro_nom',
    accessorKey: 'producto.pro_nom',
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: 'ghost',
          onClick: () => column.toggleSorting(column.getIsSorted() === 'asc')
        },
        () => ['Nombre', h(ArrowUpDown, { class: 'w-4 h-4 ml-2' })]
      );
    },
    cell: ({ row }) =>
      h('div', { class: 'ml-4' }, [row.original.producto.pro_nom]),
    enableSorting: true,
    name: 'Nombre',
    filterFn: (row, _, filterValue) => {
      return (
        row.original.producto.pro_nom.toLowerCase().includes(filterValue.toLowerCase())
      );
    },
  },
  {
    accessorKey: 'producto.tipo_producto.tip_pro_nom',
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: 'ghost',
          onClick: () => column.toggleSorting(column.getIsSorted() === 'asc')
        },
        () => ['Tipo', h(ArrowUpDown, { class: 'w-4 h-4 ml-2' })]
      );
    },
    cell: ({ row }) =>
      h('div', { class: 'ml-4' }, [
        row.original.producto.tipo_producto?.tip_pro_nom
      ]),
    name: 'Tipo'
  },
  {
    accessorKey: 'inv_stock',
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: 'ghost',
          onClick: () => {
            column.toggleSorting(column.getIsSorted() === 'asc');
          }
        },
        () => ['Stock', h(ArrowUpDown, { class: 'w-4 h-4 ml-2' })]
      );
    },
    cell: ({ row }) =>
      h('div', { class: 'ml-4' }, [row.original.inv_stock]),
    name: 'Stock'
  },
  {
    id: 'actions',
    cell: ({ row }) => {
      return h('div', { class: 'relative float-end' }, [
        h(DataTableDropdownInventory, {
          original: row.original,
          dataRef,
          postForm,
          totalRef: inventoryCount,
          entryRef: last30DaysEntries
        })
      ]);
    },
    enableSorting: false,
    enableHiding: false
  }
];

const postForm = useForm({
  id: -1,
  stock: 0
});
const filters: string = 'producto.pro_nom';

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
  <Head title="Inventario" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Inventario</h2>
    </template>
    <div class="px-4 py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex flex-col gap-y-4">
        <div class="grid grid-cols-3 gap-4">
          <div class="flex flex-col gap-y-2 items-center space-x-4 rounded-md border p-4 bg-white">
            <div class="flex-1 space-y-1">
              <p class="text-2xl font-semibold leading-none text-center">
                Productos Totales
              </p>
              <p class="text-sm text-muted-foreground text-center">
                Numero de productos creados
              </p>
            </div>
            <p class="text-5xl font-semibold leading-none">
              {{ numberFormat(inventoryCount) }}
            </p>
          </div>
          <div class=" flex flex-col gap-y-2 items-center space-x-4 rounded-md border p-4 bg-white">
            <div class="flex-1 space-y-1">
              <p class="text-2xl font-semibold leading-none text-center">
                Entradas
              </p>
              <p class="text-sm text-muted-foreground text-center">
                En los ultimos 30 dias
              </p>
            </div>
            <p class="text-5xl font-semibold leading-none">
              {{ numberFormat(last30DaysEntries) }}
            </p>
          </div>
          <div class="flex flex-col gap-y-2 items-center space-x-4 rounded-md border p-4 bg-white">
            <div class="flex-1 space-y-1">
              <p class="text-2xl font-semibold leading-none text-center">
                Salidas
              </p>
              <p class="text-sm text-muted-foreground text-center">
                En los ultimos 30 dias
              </p>
            </div>
            <p class="text-5xl font-semibold leading-none">
              {{ numberFormat(last30DaysExits) }}
            </p>
          </div>
        </div>
        <DataTable
          :data="dataRef || []"
          :columns="CLIENTS_COLUMNS as unknown as ColumnDef<any>[]"
          :filters="filters || ''"
          placeholder="Buscar productos por nombre"
        >
        </DataTable>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
