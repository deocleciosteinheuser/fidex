<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnidadeSistemaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Unidade'  => ['id' => $this->uniid],
            'Sistema'  => ['id' => $this->sisid],
            'Servidor' => ['id' => $this->serid],
            'Usuario'  => ['id' => $this->usuid],
            'mrr' => $this->mrr,
            'ativo' => $this->ativo,
            'created' => Carbon::make($this->created_at)->format('Y-m-d H:i:s'),
            'updated' => Carbon::make($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
