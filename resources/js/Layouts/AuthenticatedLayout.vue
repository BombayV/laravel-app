<script setup lang="ts">
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import {
  Cloud,
  UserSearch,
  LogOut,
  Settings,
  User,
  Box,
  ShoppingCart,
  BadgeDollarSign,
  ClipboardPlus,
  ReceiptText,
  PackageCheck
} from 'lucide-vue-next'
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuPortal,
  DropdownMenuSeparator,
  DropdownMenuShortcut,
  DropdownMenuSub,
  DropdownMenuSubContent,
  DropdownMenuSubTrigger,
  DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import {Button} from "@/Components/ui/button";
import Toaster from "@/Components/ui/toast/Toaster.vue";
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')" class="flex items-center gap-x-6">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800"
                                    />
                                  <h1 class="text-2xl font-semibold text-gray-800 leading-tight">Hueco UTE</h1>
                                </Link>
                            </div>
                        </div>

                        <div class="flex items-center">
                          <DropdownMenu>
                            <DropdownMenuTrigger as-child>
                              <Button variant="outline">
                                {{ ($page.props.auth as any).user.name }}
                              </Button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent class="w-56 mr-4 sm:mr-8 xl:mr-6 2xl:mr-0 mt-1.5">
                              <DropdownMenuLabel>Mi Cuenta</DropdownMenuLabel>
                              <DropdownMenuSeparator />
                              <DropdownMenuGroup>
                                <DropdownMenuItem as="a" :href="route('clientes')" method="get">
                                  <UserSearch class="mr-2 h-4 w-4" />
                                  <span>Clientes</span>
                                </DropdownMenuItem>
                                <DropdownMenuItem as="a" :href="route('productos')" method="get">
                                  <ShoppingCart class="mr-2 h-4 w-4" />
                                  <span>Productos</span>
                                </DropdownMenuItem>
                                <DropdownMenuItem as="a" :href="route('inventario')" method="get">
                                  <Box class="mr-2 h-4 w-4" />
                                  <span>Inventario</span>
                                </DropdownMenuItem>
                              </DropdownMenuGroup>
                              <DropdownMenuSeparator />
                              <DropdownMenuGroup>
                                <DropdownMenuItem as="a" :href="route('pedidos')" method="get">
                                  <PackageCheck class="mr-2 h-4 w-4" />
                                  <span>Pedidos</span>
                                </DropdownMenuItem>
                                <DropdownMenuItem as="a" :href="route('ventas')" method="get">
                                  <BadgeDollarSign class="mr-2 h-4 w-4" />
                                  <span>Ventas</span>
                                </DropdownMenuItem>
                                <DropdownMenuItem as="a" :href="route('facturas')" method="get">
                                  <ReceiptText class="mr-2 h-4 w-4" />
                                  <span>Facturas</span>
                                </DropdownMenuItem>
                                <DropdownMenuItem as="a" :href="route('reportes')" method="get">
                                  <ClipboardPlus class="mr-2 h-4 w-4" />
                                  <span>Reportes</span>
                                </DropdownMenuItem>
                              </DropdownMenuGroup>
                              <DropdownMenuSeparator />
                              <DropdownMenuGroup>
                                <DropdownMenuItem>
                                  <User class="mr-2 h-4 w-4" />
                                  <span>Perfil</span>
                                  <DropdownMenuShortcut>⇧⌘P</DropdownMenuShortcut>
                                </DropdownMenuItem>
                                <DropdownMenuItem>
                                  <Settings class="mr-2 h-4 w-4" />
                                  <span>Ajustes</span>
                                  <DropdownMenuShortcut>⌘S</DropdownMenuShortcut>
                                </DropdownMenuItem>
                              </DropdownMenuGroup>
                              <DropdownMenuSeparator />
                              <DropdownMenuItem disabled>
                                <Cloud class="mr-2 h-4 w-4" />
                                <span>API</span>
                              </DropdownMenuItem>
                              <DropdownMenuSeparator />
                              <Link :href="route('logout')" method="post">
                                <DropdownMenuItem as="a">
                                  <LogOut class="mr-2 h-4 w-4" />
                                  <span>Cerrar Sesión</span>
                                </DropdownMenuItem>
                              </Link>
                            </DropdownMenuContent>
                          </DropdownMenu>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
    <Toaster :duration="5000" />
</template>
