<script setup lang="ts">
import {InventoryColumn, OrderColumn} from '@/components/table/columns';
import DataTable from '@/components/table/DataTable.vue';
import { Button } from '@/components/ui/button';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import {ArrowUpDown, Trash} from 'lucide-vue-next';
import {h, ref, watch} from 'vue';
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
  result?: any;
}>();

type CustomColumnDef =
  | ColumnDef<OrderColumn>
  | {
  name: string;
};

const dataRef = ref(props.orders || []);
const CLIENTS_COLUMNS: CustomColumnDef[] = [
  {
    id: 'ped_id',
    accessorKey: 'ped_id',
    header: ({ column }) => {
      return h(
        Button,
        {
          variant: 'ghost',
          onClick: () => column.toggleSorting(column.getIsSorted() === 'asc')
        },
        () => ['ID', h(ArrowUpDown, { class: 'w-4 h-4 ml-2' })]
      );
    },
    cell: ({ row }) =>
      h('div', { class: 'ml-4' }, [row.original.ped_id]),
    enableSorting: true,
    name: 'Nombre',
    // filterFn: (row, _, filterValue) => {
    //   return (
    //     row.original.producto.pro_nom.toLowerCase().includes(filterValue.toLowerCase())
    //   );
    // },
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

const filters: string = 'ped_id';

watch(
  () => props.result,
  (value) => {
    if(value){
      dataRef.value = [...dataRef.value, value];
    }
  }
)

</script>

<template>
  <Head title="Pedidos" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Pedidos</h2>
    </template>
    <div class="px-4 py-12">
      {{ result }}
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 flex flex-col gap-y-4">
        <DataTable
          :data="dataRef || []"
          :columns="CLIENTS_COLUMNS as unknown as ColumnDef<any>[]"
          :filters="filters || ''"
          placeholder="Buscar pedidos por nombre"
        >
          <template #top>
            <DataTableDialogOrders/>
          </template>
        </DataTable>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
