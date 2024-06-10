<script lang="ts" setup>
import {
  Drawer,
  DrawerContent,
  DrawerDescription,
  DrawerFooter,
  DrawerHeader,
  DrawerTitle,
  DrawerClose,
  DrawerTrigger
} from "@/components/ui/drawer";
import { Button } from "@/components/ui/button";
import {DropdownMenuItem} from "@/components/ui/dropdown-menu";

defineProps<{
  dropdownText: string;
  title: string;
  description: string;
}>();
</script>

<template>
  <Drawer>
    <DrawerTrigger as-child>
      <DropdownMenuItem @select.prevent>
        {{ dropdownText }}
      </DropdownMenuItem>
    </DrawerTrigger>

    <DrawerContent>
      <div class="mx-auto w-full max-w-sm">
        <DrawerHeader>
          <DrawerTitle>{{ title }}</DrawerTitle>
          <DrawerDescription>{{ description }}</DrawerDescription>
        </DrawerHeader>
        <slot/>
        <DrawerFooter>
          <DrawerClose as-child>
            <Button variant="outline">
              Cerrar
            </Button>
          </DrawerClose>
        </DrawerFooter>
      </div>
    </DrawerContent>
  </Drawer>
</template>
