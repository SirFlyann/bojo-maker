<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    public $timestamps = false;
    public $guarded = [];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id', 'id');
    }

    public function itens()
    {
        return $this->hasMany('App\PedidoItem', 'pedido_id', 'id');
    }
}
