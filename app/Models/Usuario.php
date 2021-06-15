<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Funcao;
use App\Models\AluguelCarro;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'login',
        'cpf',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    public function funcao()
    {
        return $this->belongsTo('App\Models\Funcao');
    }

    public function alugueis()
    {
        return $this->toMany('App\Models\AluguelCarro');
    }

}
