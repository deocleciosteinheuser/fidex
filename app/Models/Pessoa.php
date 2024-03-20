<?php

namespace App\Models;

use App\Models\Trait\Selectable;

class Pessoa extends ModelBase
{
    use Selectable;
    protected $fillable = ['nome', 'sobrenome', 'email'];
}
