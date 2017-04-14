<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoMateria extends Model
{
    protected $table = 'produto_materia';
    public $timestamps = false;
    public $guarded = [];

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id', 'id');
    }

    public function materia()
    {
        return $this->belongsTo('App\MateriaPrima', 'materia_id', 'id');
    }
}
