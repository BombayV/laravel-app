export type ClientColumn = {
	cli_id: number;
	cli_nom: string;
	cli_ape: string;
	cli_tel: string;
	cli_ema: string;
	cli_dir: string;
	cli_sex: string;
	updated_at: string;
	created_at: string;
};

export type ProductTypeColumn = {
  tip_pro_id: number;
  tip_pro_nom: string;
};

export type ProductColumn = {
	pro_id: number;
	pro_nom: string;
	pro_val: number;
	fk_tip_pro_id: number;
	fk_est_pro_id: number;
  tipo_producto?: ProductTypeColumn;
};

export type InventoryStatusColumn = {
  est_inv_id: number;
  est_inv_nom: string;
};

export type InventoryColumn = {
	inv_id: number;
	fk_pro_id: number;
	inv_stock: number;
	fk_est_inv_id: number;
  producto: ProductColumn;
  estado_inventario: InventoryStatusColumn;
};

export type OrderColumn = {
	ped_id: number;
	ped_est: string;
	ped_tot: number;
  fk_cli_id: number;
	ped_fec: string;
  cliente: ClientColumn;
};

export type OrderDetailColumn = {
	det_ped_id: number;
	fk_ped_id: number;
  fk_pro_id: number;
	det_ped_can: number;
	det_ped_pre: number;
  producto: ProductColumn;
  pedido: OrderColumn;
};

export type InventoryLogColumn = {
	reg_inv_id: number;
	fk_inv_id: number;
	reg_inv_can: number;
	reg_inv_fec: string;
	reg_inv_tip_nom: string;
};

export type SalesColumn = {
	ven_id: number;
	fk_cli_id: number;
	ven_tot: number;
	created_at: string;
  cliente: ClientColumn;
};
