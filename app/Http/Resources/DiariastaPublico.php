<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiariastaPublico extends JsonResource
{
    /**
     * Define os dados retornados para cada diarista
     *
     * @param [type] $request
     * @return array
     */
    public function toArray($request):array
    {
        return [
            'nome' => $this->nome_completo,
            'reputacao' => $this->reputacao,
            'foto_usuario' => $this->foto_usuario,
            'cidade' => 'Uberlândia',
        ];
    }
}
