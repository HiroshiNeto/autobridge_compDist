<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'login',
        'cpf',
        'password',
    ];

    public function alugueis()
    {
        return $this->toMany('App\Models\AlguelCarro');
    }
}
