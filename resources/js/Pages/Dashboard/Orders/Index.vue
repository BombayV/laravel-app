<script setup lang="ts">
import {InventoryColumn} from '@/components/table/columns';
import DataTable from '@/components/table/DataTable.vue';
import { Button } from '@/components/ui/button';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import {ArrowUpDown, Trash} from 'lucide-vue-next';
import { h, ref } from 'vue';
import DataTableDropdownOrders from "@/Pages/Dashboard/Orders/DataTableDropdownOrders.vue";
import {
  AlertDialog, AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent, AlertDialogDescription, AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle, AlertDialogTrigger
} from "@/components/ui/alert-dialog";
import DataTableDialogOrders from "@/Pages/Dashboard/Orders/DataTableDialogOrders.vue";

const props = defineProps<{
  orders?: any;
}>();

type CustomColumnDef =
  | ColumnDef<InventoryColumn>
  | {
  name: string;
};

const dataRef = ref(props.data);
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
    id: 'actions',
    cell: ({ row }) => {
      return h('div', { class: 'relative float-end' }, [
        h(DataTableDropdownOrders, {
          original: row.original,
          dataRef,
        })
      ]);
    },
    enableSorting: false,
    enableHiding: false
  }
];

const filters: string = 'producto.pro_nom';
</script>

<template>
  <Head title="Pedidos" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Pedidos</h2>
    </template>
    <div class="px-4 py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex flex-col gap-y-4">
        <DataTable
          :data="dataRef || []"
          :columns="CLIENTS_COLUMNS as unknown as ColumnDef<any>[]"
          :filters="filters || ''"
          placeholder="Buscar pedidos por nombre"
        >
          <template #top>
            <DataTableDialogOrders :products="props.products" />
          </template>
        </DataTable>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
