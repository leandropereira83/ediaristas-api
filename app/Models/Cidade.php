<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    /**
     * Define a relação com os diaristas
     *
     * @return void
     */
    public function diaristas()
    {
        return $this->belongsToMany(User::class, 'cidade_diarista');
    }
}