<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    protected $table = 'materia_prima';
    public $timestamps = false;
    public $guarded = [];
}
