<script setup lang="ts">
import ApplicationLogo from '@/components/ApplicationLogo.vue';
import { Button } from '@/components/ui/button';
import {
	DropdownMenu,
	DropdownMenuContent,
	DropdownMenuGroup,
	DropdownMenuItem,
	DropdownMenuLabel,
	DropdownMenuSeparator,
	DropdownMenuShortcut,
	DropdownMenuTrigger
} from '@/components/ui/dropdown-menu';
import Toaster from '@/components/ui/toast/Toaster.vue';
import { Link } from '@inertiajs/vue3';
import {
	BadgeDollarSign,
	Box,
	ClipboardPlus,
	LogOut,
	PackageCheck,
	ReceiptText,
	Settings,
	ShoppingCart,
	User,
	UserSearch
} from 'lucide-vue-next';
</script>

<template>
	<div>
		<div class="min-h-screen bg-gray-100">
			<nav class="border-b border-gray-100 bg-white">
				<!-- Primary Navigation Menu -->
				<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
					<div class="flex h-16 justify-between">
						<div class="flex">
							<!-- Logo -->
							<div class="flex shrink-0 items-center">
								<Link :href="route('dashboard')" class="flex items-center gap-x-6">
									<ApplicationLogo class="block h-14 w-auto fill-current text-gray-800" />
									<h1 class="text-2xl font-semibold leading-tight text-gray-800">Hueco UTE</h1>
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
								<DropdownMenuContent class="mr-4 mt-1.5 w-56 sm:mr-8 xl:mr-6 2xl:mr-0">
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
										<DropdownMenuItem as="a" :href="route('tipos-productos')" method="get">
											<ShoppingCart class="mr-2 h-4 w-4" />
											<span>Tipo de Productos</span>
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
									<Link :href="route('logout')" method="post" as="button" class="w-full">
										<DropdownMenuItem>
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
				<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
					<slot name="header" />
				</div>
			</header>

			<!-- Page Content -->
			<main>
				<slot />
			</main>
		</div>
	</div>
	<Toaster />
</template>
