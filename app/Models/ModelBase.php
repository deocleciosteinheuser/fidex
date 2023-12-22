<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ModelBase extends Model {
    use HasFactory;
    
    /**
     * {@inheritDoc}
     */
    public function getTable()
    {
        return $this->table ?? Str::snake(class_basename($this));
    }

    /**
     * {@inheritDoc}
     */
    public static function updateOrCreate(array $attributes = [], array $values = []) {
        $attributes = array_filter($attributes);
        if(count($attributes)) {
            return (new static)->parentMethod('updateOrCreate', $attributes, $values);    
        }
        return (object)['id' => null, 'nome' => null];
    }

    /**
     * a magic function __call faz um new static o que faz a função ser chamada novamente então é necessário essa chamada com o objeto já criado para não entrar em loop
     */
    private function parentMethod(string $sMethod, ...$aParam) {
       return parent::$sMethod(...$aParam);
    }    
}