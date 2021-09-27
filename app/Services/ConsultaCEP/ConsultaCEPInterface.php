<?php

namespace App\Services\ConsultaCEP;

interface ConsultaCEPInterface
{
    public function buscar(string $cep):false|EnderecoResponse;
}