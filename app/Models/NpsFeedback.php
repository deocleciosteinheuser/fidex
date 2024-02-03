<?php

namespace App\Models;

class NpsFeedback extends ModelBase
{
    protected $fillable = ['npuid', 'visto', 'util', 'descricao', 'pesid'];
    protected $primaryKey = 'npuid';
}
