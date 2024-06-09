<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DataTable from "@/components/table/DataTable.vue";
import type {ClientColumn} from "@/components/table/columns";
import { data } from "@/components/table/columns";
import {ColumnDef} from "@tanstack/vue-table";
import {h} from "vue";
import {Checkbox} from "@/components/ui/checkbox";
import {Button} from "@/components/ui/button";
import {ArrowUpDown} from "lucide-vue-next";

type CustomColumnDef = ColumnDef<ClientColumn> | {
  name: string;
}

const CLIENTS_COLUMNS: CustomColumnDef[] = [
  {
    id: 'select',
    header: ({ table }) => h(Checkbox, {
      'checked': table.getIsAllPageRowsSelected() || table.getIsSomePageRowsSelected() && 'indeterminate',
      'onUpdate:checked': value => table.toggleAllPageRowsSelected(!!value),
      'ariaLabel': 'Seleccionar todas las filas'
    }),
    cell: ({ row }) => h(Checkbox, {
      'checked': row.getIsSelected(),
      'onUpdate:checked': value => row.toggleSelected(!!value),
      'ariaLabel': 'Seleccionar fila'
    }),
    enableSorting: false,
    enableHiding: false,
  },
  {
    accessorKey: 'cli_nom',
    header: ({ column }) => {
      return h(Button, {
        variant: 'ghost',
        onClick: () => column.toggleSorting(column.getIsSorted() === 'asc')
      }, () => ['Nombre', h(ArrowUpDown, { class: 'w-4 h-4 ml-2' })])
    },
    cell: ({ row }) => h('div', { class: 'ml-4' }, [row.original.cli_nom, ' ', row.original.cli_ape]),
    filterFn: (row, _, filterValue) => {
      return row.original.cli_nom.toLowerCase().includes(filterValue.toLowerCase())
        || row.original.cli_ape.toLowerCase().includes(filterValue.toLowerCase())
        || row.original.cli_ema.toLowerCase().includes(filterValue.toLowerCase())
    },
    name: 'Nombre',
  },
  {
    accessorKey: 'cli_ema',
    header: () => h('div', { class: 'text-right' }, ['Email']),
    cell: ({ row }) => h('div', { class: 'text-right' }, [row.original.cli_ema]),
    name: 'Email',
  },
  {
    accessorKey: 'cli_tel',
    header: () => h('div', { class: 'text-right' }, ['Teléfono']),
    cell: ({ row }) => h('div', { class: 'text-right' }, [row.original.cli_tel]),
    name: 'Teléfono',
  },
  {
    accessorKey: 'updated_at',
    header: () => h('div', { class: 'text-right' }, ['Última actualización']),
    cell: ({ row }) => h('div', { class: 'text-right' }, [row.original.updated_at]),
    name: 'Última actualización',
  },
];

const filters: string = 'cli_nom'
</script>

<template>
  <Head title="Clientes" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clientes</h2>
    </template>

    <div class="py-12 px-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <DataTable :data="data" :columns="CLIENTS_COLUMNS as unknown as ColumnDef<any>[]" :filters="filters" />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
