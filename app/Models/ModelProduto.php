<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ModelProduto extends Model implements Auditable
{
      use \OwenIt\Auditing\Auditable;
    // Indicar o nome da tabela
     protected $table ='tb_produtos';

     //guardar todos dados
     protected $fillable = [];

     
}
