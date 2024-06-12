<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {ColumnDef} from "@tanstack/vue-table";
import {
  AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter, AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogTrigger
} from "@/components/ui/alert-dialog";
import DataTableDialogCliente from "@/Pages/Dashboard/Clients/DataTableDialogClient.vue";
import {Button} from "@/components/ui/button";
import DataTable from "@/components/table/DataTable.vue";
import {ArrowUpDown, Trash} from "lucide-vue-next";
import {h, ref, watch} from "vue";
import {Checkbox} from "@/components/ui/checkbox";
import DataTableDropdownProduct from "@/Pages/Dashboard/Products/DataTableDropdownProduct.vue";
import {ProductColumn} from "@/components/table/columns";
import {toast} from "@/components/ui/toast";

const props = defineProps<{
	data?: any;
  result?: any;
}>();

type CustomColumnDef =
  | ColumnDef<ProductColumn>
  | {
      name: string;
  };

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
  {
    accessorKey: 'cli_nom',
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
      h('div', { class: 'ml-4' }, ['Test']),
    // filterFn: (row, _, filterValue) => {
    //   return (
    //
    //   );
    // },
    name: 'Nombre',
    enableHiding: false
  },
  {
    id: 'actions',
    cell: ({ row }) => {
      return h('div', { class: 'relative float-end' }, [
        h(DataTableDropdownProduct, {
          original: row.original,
          deleteForm: deleteForm,
          updateForm: updateForm,
          dataRef: dataRef
        })
      ]);
    },
    enableSorting: false,
    enableHiding: false
  }
];

const deleteForm = useForm({
  id: -1
});
const deleteAllForm = useForm({
  ids: <number[]>[]
});
const updateForm = useForm({

});
const form = useForm({

});
const dataRef = ref(props.data);
const filters: string = '';

const deleteAll = () => {

};

watch(
  () => props.result,
  (value) => {
    if (value) {
      dataRef.value = [
        ...dataRef.value,
        value
      ]
    }
  }
)
</script>

<template>
	<Head title="Productos" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="text-xl font-semibold leading-tight text-gray-800">Productos</h2>
		</template>
    <div class="px-4 py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <DataTable
          :data="dataRef || []"
          :columns="CLIENTS_COLUMNS as unknown as ColumnDef<any>[]"
          :filters="filters || ''"
          placeholder="Buscar productos por nombre o tipo"
          @update:selectedRows="(table) => {
            selectedRows = table.getSelectedRowModel();
            table.toggleAllRowsSelected(selectedRows.rows.length === dataRef.length);
          }"
        >
          <template #top>
            <div class="flex justify-end gap-x-2">
              <AlertDialog>
                <AlertDialogTrigger as-child>
                  <Button v-if="selectedRows.rows.length > 0" size="icon" variant="destructive" type="submit">
                    <Trash class="w-4 h-4" />
                  </Button>
                </AlertDialogTrigger>
                <AlertDialogContent>
                  <AlertDialogHeader>
                    <AlertDialogTitle class="text-lg font-semibold">Eliminar {{ selectedRows.rows.length }} productos(s)</AlertDialogTitle>
                    <AlertDialogDescription>
                      ¿Estás seguro de que deseas eliminar {{ selectedRows.rows.length }} productos(s)? Esta acción no se puede deshacer y se eliminarán permanentemente.
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
              <DataTableDialogCliente :form="form" />
            </div>
          </template>
        </DataTable>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
