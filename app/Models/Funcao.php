<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    use HasFactory;

    protected $table = 'funcoes';

    protected $fillable = [
        'nome'
    ];

    public function usuarios()
    {
        return $this->toMany('App\Models\Usuario');
    }
}
