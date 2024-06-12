<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
  use HasFactory;

  protected $table = 'producto';

  protected $primaryKey = 'cli_id';
  protected $fillable = [
    'cli_nom',
    'cli_ape',
    'cli_tel',
    'cli_ema',
    'cli_dir',
    'cli_sex'
  ];
}

