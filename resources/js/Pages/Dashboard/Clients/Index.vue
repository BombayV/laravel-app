<script setup lang="ts">
import type { ClientColumn } from '@/components/table/columns';
import DataTable from '@/components/table/DataTable.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { ArrowUpDown } from 'lucide-vue-next';
import {h, ref, watch} from 'vue';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger
} from "@/components/ui/dialog";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import {Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select";
import {useToast} from "@/components/ui/toast";

const props = defineProps<{
	data?: any;
  result?: any;
}>();

type CustomColumnDef =
	| ColumnDef<ClientColumn>
	| {
			name: string;
	  };

const { toast } = useToast();
const CLIENTS_COLUMNS: CustomColumnDef[] = [
	{
		id: 'select',
		header: ({ table }) =>
			h(Checkbox, {
				checked:
					table.getIsAllPageRowsSelected() ||
					(table.getIsSomePageRowsSelected() && 'indeterminate'),
				'onUpdate:checked': (value) => table.toggleAllPageRowsSelected(!!value),
				ariaLabel: 'Seleccionar todas las filas'
			}),
		cell: ({ row }) =>
			h(Checkbox, {
				checked: row.getIsSelected(),
				'onUpdate:checked': (value) => row.toggleSelected(!!value),
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
			h('div', { class: 'ml-4' }, [row.original.cli_nom, ' ', row.original.cli_ape]),
		filterFn: (row, _, filterValue) => {
			return (
				row.original.cli_nom.toLowerCase().includes(filterValue.toLowerCase()) ||
				row.original.cli_ape.toLowerCase().includes(filterValue.toLowerCase()) ||
				row.original.cli_ema.toLowerCase().includes(filterValue.toLowerCase())
			);
		},
		name: 'Nombre'
	},
	{
		accessorKey: 'cli_ema',
		header: () => h('div', { class: 'text-right' }, ['Email']),
		cell: ({ row }) => h('div', { class: 'text-right' }, [row.original.cli_ema]),
		name: 'Email'
	},
	{
		accessorKey: 'cli_tel',
		header: () => h('div', { class: 'text-right' }, ['Teléfono']),
		cell: ({ row }) => h('div', { class: 'text-right' }, [row.original.cli_tel]),
		name: 'Teléfono'
	},
	{
		accessorKey: 'updated_at',
		header: () => h('div', { class: 'text-right' }, ['Última actualización']),
		cell: ({ row }) => h('div', { class: 'text-right' }, [row.original.updated_at]),
		name: 'Última actualización'
	},
  {
    id: 'actions',
    header: () => h('div', { class: 'text-right' }, ['Acciones']),
    cell: () => h('div', { class: 'text-right' }, [
      // h(Button, { variant: 'outline' }, ['Editar']),
      // h(Button, { variant: 'outline' }, ['Eliminar'])
    ]),
    enableSorting: false,
    enableHiding: false
  }
];

const data = ref(props.data);
const form = useForm({
  nombre: '',
  apellido: '',
  telefono: '',
  email: '',
  direccion: '',
  sexo: '',
});
const filters: string = 'cli_nom';

const submit = () => {
  form.post(route('clientes.store'), {
    onSuccess: (none) => {
      console.log('Form submitted');
      console.log(none);
      form.reset();
    },
    onError: (errors) => {
      console.log(errors);
      toast({
        title: 'Error al crear el cliente',
        description: Object.values(errors)[0] || 'Por favor, revise los campos e intente de nuevo.',
        duration: 5000,
        variant: 'destructive'
      });
    }
  });
};

watch(
  () => props.result,
  (result) => {
    data.value.push(result);
  }
)

</script>

<template>
	<Head title="Clientes" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="text-xl font-semibold leading-tight text-gray-800">Clientes</h2>
		</template>

		<div class="px-4 py-12">
			<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
				<DataTable
					:data="data"
					:columns="CLIENTS_COLUMNS as unknown as ColumnDef<any>[]"
					:filters="filters"
          placeholder="Buscar clientes por nombre o email"
				>
          <template #top>
            <Dialog>
              <DialogTrigger>
                <Button>
                  Crear Cliente
                </Button>
              </DialogTrigger>
                <DialogContent class="sm:max-w-[425px]">
                  <form @submit.prevent="submit">
                    <DialogHeader>
                      <DialogTitle>
                        Crear nuevo cliente
                      </DialogTitle>
                      <DialogDescription>
                        Complete los campos para crear un nuevo cliente.
                      </DialogDescription>
                    </DialogHeader>
                    <div class="grid gap-4 py-4">
                      <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="nombre" class="text-right">
                          Nombre
                        </Label>
                        <Input id="nombre" class="col-span-3" required v-model="form.nombre" autofocus />
                      </div>
                      <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="apellido" class="text-right">
                          Apellido
                        </Label>
                        <Input id="apellido" class="col-span-3" required v-model="form.apellido" />
                      </div>
                      <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="email" class="text-right">
                          Email
                        </Label>
                        <Input id="email" class="col-span-3" required v-model="form.email" />
                      </div>
                      <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="telefono" class="text-right">
                          Teléfono
                        </Label>
                        <Input id="telefono" class="col-span-3" required v-model="form.telefono" />
                      </div>
                      <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="direccion" class="text-right">
                          Dirección
                        </Label>
                        <Input id="direccion" class="col-span-3" required v-model="form.direccion" />
                      </div>
                      <div class="grid grid-cols-4 items-center gap-4">
                        <Label for="sexo" class="text-right col-span-1">
                          Sexo
                        </Label>
                        <Select v-model="form.sexo">
                          <SelectTrigger class="col-span-3">
                            <SelectValue placeholder="Seleccione el sexo" />
                          </SelectTrigger>
                          <SelectContent>
                            <SelectGroup>
                              <SelectItem value="m">
                                Hombre
                              </SelectItem>
                              <SelectItem value="f">
                                Mujer
                              </SelectItem>
                              <SelectItem value="o">
                                Otro
                              </SelectItem>
                            </SelectGroup>
                          </SelectContent>
                        </Select>
                      </div>
                    </div>
                    <DialogFooter>
                      <Button type="submit">
                        Crear nuevo cliente
                      </Button>
                    </DialogFooter>
                  </form>
                </DialogContent>
            </Dialog>
          </template>
        </DataTable>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
