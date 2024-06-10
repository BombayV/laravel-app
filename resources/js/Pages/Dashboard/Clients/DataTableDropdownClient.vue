<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
	DropdownMenu,
	DropdownMenuContent,
	DropdownMenuItem,
	DropdownMenuLabel,
	DropdownMenuSeparator,
	DropdownMenuTrigger
} from '@/components/ui/dropdown-menu';
import { MoreHorizontal, CalendarDays, Phone, Map } from 'lucide-vue-next';
import {ClientColumn} from "@/components/table/columns";
import AlertDialogItem from "@/components/table/AlertDialogItem.vue";
import DrawerItem from "@/components/table/DrawerItem.vue";
import {useForm} from "@inertiajs/vue3";
import { toast } from "@/components/ui/toast";

const props = defineProps<{
  original: ClientColumn;
  deleteForm: ReturnType<typeof useForm<{id: number}>>;
  dataRef: any;
}>();

const deleteSubmit = async () => {
  if (props.deleteForm.id <= -1) {
    toast({
      title: 'Error al eliminar',
      description: 'No se ha seleccionado un cliente para eliminar.',
      duration: 5000,
      variant: 'destructive'
    });
    return;
  }

  props.deleteForm.delete(route('clientes.destroy'), {
    onSuccess: () => {
      toast({
        title: 'Cliente eliminado',
        description: 'El cliente ha sido eliminado exitosamente.',
        duration: 5000
      });

      props.dataRef.value = props.dataRef.value.filter((item: any) => item.cli_id !== props.deleteForm.id);
      props.deleteForm.id = -1;
    },
    onError: (errors) => {
      toast({
        title: 'Error al eliminar el cliente',
        description: Object.values(errors)[0] || 'Por favor, revise los campos e intente de nuevo.',
        duration: 5000,
        variant: 'destructive'
      });
    }
  });
};
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button variant="ghost" class="h-8 w-8 p-0">
        <span class="sr-only">Open menu</span>
        <MoreHorizontal class="h-4 w-4" />
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuLabel>Acciones</DropdownMenuLabel>
      <DrawerItem
        dropdownText="Ver cliente"
        :title="original.cli_nom + ' ' + original.cli_ape"
        :description="original.cli_ema"
      >
        <div class="p-4 pb-0 w-full relative">
          <div class="grid grid-cols-2 gap-2 w-full">
            <div class="flex items-center space-x-4 rounded-md border p-4 w-full">
              <Phone/>
              <div class="flex-1 space-y-1">
                <p class="text-sm font-medium leading-none">
                  Telefono
                </p>
                <p class="text-sm text-muted-foreground">
                  {{ original.cli_tel }}
                </p>
              </div>
            </div>
            <div class="flex items-center space-x-4 rounded-md border p-4 w-full">
              <CalendarDays />
              <div class="flex-1 space-y-1">
                <p class="text-sm font-medium leading-none">
                  Sexo
                </p>
                <p class="text-sm text-muted-foreground">
                  {{ original.cli_sex === 'O' ? 'Otro' : original.cli_sex === 'M' ? 'Masculino' : 'Femenino' }}
                </p>
              </div>
            </div>
            <div class="col-span-2 flex items-center space-x-4 rounded-md border p-4 w-full">
              <Map />
              <div class="flex-1 space-y-1">
                <p class="text-sm font-medium leading-none">
                  Dirección
                </p>
                <p class="text-sm text-muted-foreground">
                  {{ original.cli_dir }}
                </p>
              </div>
            </div>
            <div class="col-span-2 flex items-center space-x-4 rounded-md border p-4 w-full">
              <CalendarDays/>
              <div class="flex-1 space-y-1">
                <p class="text-sm font-medium leading-none">
                  Fecha de creacion
                </p>
                <p class="text-sm text-muted-foreground">
                  {{ new Date(original.created_at).toLocaleDateString() }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </DrawerItem>
      <DropdownMenuSeparator />
      <DropdownMenuItem>Editar cliente</DropdownMenuItem>

      <!-- Eliminar cliente -->
      <AlertDialogItem
        dropdownText="Eliminar cliente"
        title="Eliminar cliente"
        description="Esta acción no se puede deshacer. Esto eliminará permanentemente al cliente y eliminará sus datos del servidor."
        cancel="Cancelar"
        action="Eliminar"
        @submit="deleteSubmit"
        @opened="() => props.deleteForm.id = props.original.cli_id"
        @closed="() => props.deleteForm.id = -1"
      >
      </AlertDialogItem>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
