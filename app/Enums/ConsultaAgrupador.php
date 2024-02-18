<?php
namespace App\Enums;

use PhpParser\Node\Stmt\Switch_;

enum ConsultaAgrupador {

    case USUARIO;
    case SERVIDOR;
    case CATEGORIA;
    case PERIODO;
    case SISTEMA;
    case CLIENTE;
    case UNIDADE;
    case GEO;

    public static function all() {
        return [
            static::USUARIO,
            static::SERVIDOR,
            static::CATEGORIA,
            static::PERIODO,
            static::SISTEMA,
            static::CLIENTE,
            static::UNIDADE,
            static::GEO,
        ];
    }

    public static function dados(ConsultaAgrupador $tipo) {
        switch($tipo) {
            case static::USUARIO :
                return [
                    'route' => 'usuario',
                    'title' => 'Usuário',
                    'field' => 'usucid',
                ];
                break;
            case static::SERVIDOR :
                return [
                    'route' => 'servidor',
                    'title' => 'Servidor',
                    'field' => 'serid',
                ];
                break;
            case static::CATEGORIA :
                return [
                    'route' => 'categoria',
                    'title' => 'Categoria',
                    'field' => 'catid',
                ];
                break;
            case static::PERIODO :
                return [
                    'route' => 'periodo',
                    'title' => 'Periodo',
                    'field' => 'npsperiodo',
                ];
                break;
            case static::SISTEMA :
                return [
                    'route' => 'sistema',
                    'title' => 'Sistema',
                    'field' => 'sisid',
                ];
                break;
            case static::CLIENTE :
                return [
                    'route' => 'cliente',
                    'title' => 'Cliente',
                    'field' => 'cliid',
                ];
                break;
            case static::UNIDADE :
                return [
                    'route' => 'unidade',
                    'title' => 'Unidade',
                    'field' => 'uniid',
                ];
                break;
            case static::GEO :
                return [
                    'route' => 'geo',
                    'title' => 'Geo',
                    'field' => 'geoid',
                ];
                break;
        }
    }
}
