<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    public $timestamps = false;
    public $guarded = [];

    public function materiasPrimas()
    {
        return $this->hasManyThrough('App\MateriaProduto', 'App\MateriaPrima', 'materia_id', 'id');
    }
}
