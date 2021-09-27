<?php

namespace App\Http\Controllers\Diarista;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiariastaPublicoCollection;
use App\Models\User;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ObtemDiaristasPorCep extends Controller
{
    /**
     * Busca diaristas por CEP
     *
     * @param Request $request
     * @param ConsultaCEPInterface $servicoCEP
     * @return JsonResponse|DiariastaPublicoCollection
     */
    public function __invoke(Request $request, ConsultaCEPInterface $servicoCEP):JsonResponse|DiariastaPublicoCollection
    {
        $dados = $servicoCEP->buscar($request->cep ?? '');

        If ($dados === false){
            return response()->json(["erro" => "CEP inválido"], 400);
        }

        return new DiariastaPublicoCollection(
            User::diaristasDisponivelCidadeTotal($dados->ibge),
            User::diaristasDisponivelCidade($dados->ibge)
        );
    }
}