<?php

namespace sisTareas;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colaborador extends Model
{
    use SoftDeletes;
    protected $table = "colaborador";
    protected $hidden = ['updated_at'];
}
