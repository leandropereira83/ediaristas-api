<?php

use App\Http\Controllers\Diarista\ObtemDiaristasPorCep;
use Illuminate\Support\Facades\Route;

Route::get('/diaristas/localidades', ObtemDiaristasPorCep::class)->name('diaristas.busca_por_cep');