<?php

namespace App\Services\ConsultaCEP\Providers;

use App\Services\ConsultaCEP\ConsultaCEPInterface;
use App\Services\ConsultaCEP\EnderecoResponse;
use Illuminate\Support\Facades\Http;

class ViaCEP implements ConsultaCEPInterface
{

    /**
     * Undocumented function
     *
     * @param string $cep
     * @return false|EnderecoResponse
     */
    public function buscar(string $cep): false|EnderecoResponse
    {
        //Transformar cep em código do IBGE
        $resposta = Http::get("https://viacep.com.br/ws/$cep/json/");

        if($resposta->failed()){
            return false;
        }

        $dados = $resposta->json();
        if (isset($dados["erro"]) && $dados["erro"] === true){
            return false;
        }

        return $this->populaEnderecoResponse($dados);
    }

    /**
     * Formata a saída para EndereçoResponse
     *
     * @param array $dados
     * @return EnderecoResponse
     */
    private function populaEnderecoResponse(array $dados):EnderecoResponse
    {
        return new EnderecoResponse(
            cep: $dados["cep"],
            logradouro: $dados["logradouro"],
            complemento: $dados["complemento"],
            bairro: $dados["bairro"],
            localidade: $dados["localidade"],
            uf: $dados["uf"],
            ibge: $dados["ibge"]
        );
    }
}
