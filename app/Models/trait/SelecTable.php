<?php

namespace App\Models\Trait;

trait Selectable
{
    /**
     * Retorna um array de IDs e nomes para ser usado em um elemento select.
     *
     * @param string $idColumn Nome da coluna que contém o ID.
     * @param string $nameColumn Nome da coluna que contém o nome.
     * @return array
     */
    public static function getSelectOptions($idColumn = 'id', $nameColumn = 'nome')
    {
        return self::query()
            ->select($idColumn, $nameColumn)
            ->get()
            ->pluck($nameColumn, $idColumn)
            ->toArray();
    }

}
