<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Define a relaçao com as cidades atendidas pelo(a) diarista
     *
     * @return void
     */
    public function cidadesAtendidas()
    {
        return $this->belongsToMany(Cidade::class, 'cidade_diarista');
    }

    /**
     * Escopo que filtra as diaristas
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeDiarista(Builder $query): Builder
    {
        return $query->where('tipo_usuario','=',2);
    }

    /**
     * Escopo que filtra diaristas por codigo do IBGE
     *
     * @param Builder $query
     * @param integer $codigo_ibge
     * @return Builder
     */
    public function scopeDiaristasAtendeCidade(Builder $query, int $codigo_ibge ): Builder
    {
        return $query->diarista()
            ->whereHas('cidadesAtendidas', function($q) use ($codigo_ibge){
                $q->where('codigo_ibge','=',$codigo_ibge);
            });
    }

    /**
     * Undocumented function
     *
     * @param integer $codigo_ibge
     * @return void
     */
    static public function diaristasDisponivelCidade(int $codigo_ibge):int
    {
        return $quantidadeDiaristas = User::diaristasAtendeCidade($codigo_ibge)->count();

    }

    /**
     * Undocumented function
     *
     * @param integer $codigo_ibge
     * @return integer
     */
    static public function diaristasDisponivelCidadeTotal(int $codigo_ibge)
    {
        return $diaristas = User::diaristasAtendeCidade($codigo_ibge)->limit(6)->get();
    }
}