<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
  protected $table = 'ventas';
  protected $primaryKey = 'ven_id';
  protected $fillable = [
    'fk_cli_id',
    'ven_tot',
    'created_at',
    'updated_at',
  ];
  public $timestamps = true;

  public function cliente()
  {
      return $this->belongsTo(Cliente::class, 'fk_cli_id', 'cli_id');
  }

  public function detalleVenta()
  {
      return $this->hasMany(DetalleVenta::class, 'fk_ven_id', 'ven_id');
  }
}
