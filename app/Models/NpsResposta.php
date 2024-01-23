<?php

namespace App\Models;

class NpsResposta extends ModelBase
{
    protected $fillable = ['npuid','data', 'npsnota', 'descricao', 'catid'];
    protected $primaryKey = 'npuid';
}
