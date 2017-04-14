<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table = 'pedidos_itens';
    public $timestamps = false;
    public $guarded = [];

    public function pedido()
    {
        return $this->belongsTo('App\Pedido', 'pedido_id', 'id');
    }

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id', 'id');
    }
}
