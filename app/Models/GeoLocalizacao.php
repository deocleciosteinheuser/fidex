<?php

namespace App\Models;

use App\Models\Trait\Selectable;

class GeoLocalizacao extends ModelBase
{
    use Selectable;
    protected $fillable = ['nome'];

}
