<script lang="ts" setup>
import {ref} from "vue";

const props = defineProps<{
  data: any[];
  columns: ColumnDef<any>[];
}>()

import {Input} from "@/Components/ui/input";
import {
  DropdownMenu,
  DropdownMenuCheckboxItem,
  DropdownMenuContent,
  DropdownMenuTrigger
} from "@/Components/ui/dropdown-menu";
import {Button} from "@/Components/ui/button";
import {
  ColumnDef,
  ColumnFiltersState, getCoreRowModel,
  getFilteredRowModel, getPaginationRowModel, getSortedRowModel,
  SortingState,
  useVueTable,
  VisibilityState
} from "@tanstack/vue-table";
import {valueUpdater} from "@/lib/utils";

const sorting = ref<SortingState>([])
const columnFilters = ref<ColumnFiltersState>([])
const columnVisibility = ref<VisibilityState>({})
const rowSelection = ref({})

const table = useVueTable({
  data: props.data,
  columns: props.columns,
  getCoreRowModel: getCoreRowModel(),
  getPaginationRowModel: getPaginationRowModel(),
  getSortedRowModel: getSortedRowModel(),
  getFilteredRowModel: getFilteredRowModel(),
  onSortingChange: updaterOrValue => valueUpdater(updaterOrValue, sorting),
  onColumnFiltersChange: updaterOrValue => valueUpdater(updaterOrValue, columnFilters),
  onColumnVisibilityChange: updaterOrValue => valueUpdater(updaterOrValue, columnVisibility),
  onRowSelectionChange: updaterOrValue => valueUpdater(updaterOrValue, rowSelection),
  state: {
    get sorting() { return sorting.value },
    get columnFilters() { return columnFilters.value },
    get columnVisibility() { return columnVisibility.value },
    get rowSelection() { return rowSelection.value },
  },
})
</script>

<template>
  <div class="w-full">
    <div class="flex items-center justify-between">
      <Input class="max-w-sm" placeholder="Filtrar por nombre"/>
      <DropdownMenu>
        <DropdownMenuTrigger as-child>
          <Button variant="outline" class="ml-auto">
            Test
          </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end">
          <DropdownMenuCheckboxItem
            v-for="column in table.getAllColumns().filter((column) => column.getCanHide())"
            :key="column.id"
            class="capitalize"
            :checked="column.getIsVisible()"
            @update:checked="(value) => {
              column.toggleVisibility(!!value)
            }"
          >
            {{ column.id }}
          </DropdownMenuCheckboxItem>
        </DropdownMenuContent>
      </DropdownMenu>
    </div>

<!--    <div v-if="column.getCanSort()" :class="cn('flex items-center space-x-2', { 'text-gray-500': !column.getIsSorted() })">-->
<!--      <span>{{ column.id }}</span>-->
<!--      <span v-if="column.getCanSort()" @click="column.toggleSort()">-->
<!--        {{ column.getIsSorted() ? (column.getSortDirection() === 'asc' ? '▲' : '▼') : '↕' }}-->
<!--      </span>-->
<!--    </div>-->
<!--    <div v-else>-->
<!--      <span>{{ column.id }}</span>-->
<!--    </div>-->
<!--  </div>-->
</template>
