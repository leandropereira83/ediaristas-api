<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DiariastaPublicoCollection extends ResourceCollection
{
    public static $wrap = 'diaristas';

    private int $quantidadeDiaristas;

    public function __construct($resource, int $quantidadeDiaristas)
    {
        parent::__construct($resource);

        $this->quantidadeDiaristas = $quantidadeDiaristas - 6;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'diaristas' => DiariastaPublico::collection($this->collection),
            'quantidade_diaristas' => $this->quantidadeDiaristas > 0 ? $this->quantidadeDiaristas : 0
        ];
    }
}
