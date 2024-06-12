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

export type ProductColumn = {
  pro_id: number;
  pro_nom: string;
  pro_val: number;
  est_pro_nom: string;
  tip_pro_nom: string;
};

export type InventoryColumn = {
  inv_id: number;
  pro_nom: string;
  pro_val: number;
  pro_id: number;
  inv_stock: number;
  est_inv_des: string;
};

export type OrderColumn = {
  ped_id: number;
  ped_est: string;
  ped_tot: number;
  cli_nom: string;
  cli_ape: string;
  cli_dir: string;
  ped_fec: string;
};

export type OrderDetailColumn = {
  det_ped_id: number;
  pro_nom: string;
  pro_val: number;
  det_ped_can: number;
  det_ped_pre: number;
};

export type InventoryLogColumn = {
  reg_inv_id: number;
  inv_id: number;
  pro_nom: string;
  reg_inv_can: number;
  reg_inv_fec: string;
  reg_inv_tip_nom: string;
}

export type SalesColumn = {
  ven_id: number;
  cli_nom: string;
  cli_ape: string;
  cli_dir: string;
  ven_tot: number;
  created_at: string;
};
