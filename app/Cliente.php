<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;
    public $guarded = [];

    public function pedidos()
    {
        return $this->hasMany('App\Pedido', 'cliente_id', 'id');
    }
}
