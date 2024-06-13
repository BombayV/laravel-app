<script setup lang="ts">
import { ProductColumn } from '@/components/table/columns';
import DataTable from '@/components/table/DataTable.vue';
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger
} from '@/components/ui/alert-dialog';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { toast } from '@/components/ui/toast';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { ArrowUpDown, Trash } from 'lucide-vue-next';
import { h, ref, watch } from 'vue';
import {cn} from "@/lib/utils";
import DataTableDialogInventory from "@/Pages/Dashboard/Inventory/DataTableDialogInventory.vue";

const props = defineProps<{
  data?: any;
  inventory?: any;
  inventory_count?: any;
  last_30_days_entries?: any;
  last_30_days_exits?: any;
}>();

type CustomColumnDef =
  | ColumnDef<ProductColumn>
  | {
  name: string;
};

const dataRef = ref(props.data);
const selectedRows = ref<{
  rows: any[];
  flatRows: any[];
  rowsById: Record<string, any>;
}>({
  rows: [],
  flatRows: [],
  rowsById: {}
});
const CLIENTS_COLUMNS: CustomColumnDef[] = [
  {
    id: 'select',
    header: ({ table }) =>
      h(Checkbox, {
        checked:
          table.getIsAllPageRowsSelected() ||
          (table.getIsSomePageRowsSelected() && 'indeterminate'),
        'onUpdate:checked': (value) => {
          table.toggleAllPageRowsSelected(!!value);
          selectedRows.value = table.getSelectedRowModel();
        },
        ariaLabel: 'Seleccionar todas las filas'
      }),
    cell: ({ row, table }) =>
      h(Checkbox, {
        checked: row.getIsSelected(),
        'onUpdate:checked': (value) => {
          row.toggleSelected(!!value);
          selectedRows.value = table.getSelectedRowModel();
        },
        ariaLabel: 'Seleccionar fila'
      }),
    enableSorting: false,
    enableHiding: false
  },
];

const postForm = useForm({
});
const deleteForm = useForm({
  id: -1
});
const deleteAllForm = useForm({
  ids: <number[]>[]
});
const updateForm = useForm({
  id: -1,
});
const filters: string = 'pro_nom';

const deleteAll = () => {
  for (const row of selectedRows.value.rows) {
    deleteAllForm.ids.push();
  }
};

const numberFormat = (num: number) => {
  if (num > 999 && num < 1000000) {
    return (num / 1000).toFixed(1) + 'K';
  } else if (num > 1000000) {
    return (num / 1000000).toFixed(1) + 'M';
  } else if (num < 900) {
    return num;
  }
};

watch(
  () => props.result,
  (value) => {
    if (value) {
      dataRef.value = [...dataRef.value, value];
    }
  }
);
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
              {{ numberFormat(inventory_count) }}
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
              {{ numberFormat(last_30_days_entries) }}
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
              {{ numberFormat(last_30_days_exits) }}
            </p>
          </div>
        </div>
        <DataTable
          :data="dataRef || []"
          :columns="CLIENTS_COLUMNS as unknown as ColumnDef<any>[]"
          :filters="filters || ''"
          placeholder=""
          @update:selectedRows="
						(table) => {
							table.toggleAllRowsSelected(selectedRows.rows.length === dataRef.length);
              selectedRows = table.getSelectedRowModel();
						}
					"
        >
          <template #top>
            <div class="flex justify-end gap-x-2">
              <AlertDialog>
                <AlertDialogTrigger as-child>
                  <Button
                    v-if="selectedRows.rows.length > 0"
                    size="icon"
                    variant="destructive"
                    type="submit"
                  >
                    <Trash class="h-4 w-4" />
                  </Button>
                </AlertDialogTrigger>
                <AlertDialogContent>
                  <AlertDialogHeader>
                    <AlertDialogTitle class="text-lg font-semibold"
                    >Eliminar {{ selectedRows.rows.length }} productos(s)</AlertDialogTitle
                    >
                    <AlertDialogDescription>
                      ¿Estás seguro de que deseas eliminar
                      {{ selectedRows.rows.length }} productos(s)? Esta acción no se puede deshacer
                      y se eliminarán permanentemente.
                    </AlertDialogDescription>
                  </AlertDialogHeader>
                  <AlertDialogFooter>
                    <AlertDialogCancel>Cancelar</AlertDialogCancel>
                    <AlertDialogAction
                      variant="destructive"
                      @click="deleteAll"
                      :disabled="deleteAllForm.processing"
                    >
                      Eliminar
                    </AlertDialogAction>
                  </AlertDialogFooter>
                </AlertDialogContent>
              </AlertDialog>
            </div>
          </template>
        </DataTable>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
