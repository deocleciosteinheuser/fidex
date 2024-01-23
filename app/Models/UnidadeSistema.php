<?php

namespace App\Models;

class UnidadeSistema extends ModelBase
{
    protected $primaryKey = 'uniid';
    protected $fillable = ['uniid', 'sisid', 'serid', 'usuid', 'mrr', 'ativo'];
}
