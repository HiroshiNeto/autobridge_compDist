<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AluguelCarro extends Model
{
    use HasFactory;
    private $veiculo_id;

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }

    public function veiculo()
    {
        return $this->belongsTo('App\Models\Veiculo');
    }

    public function veiculoDisponivelParaAluguel(): bool
    {
        $aluguelCarro = $this::where('veiculo_id', $this->veiculo_id)
            ->where('ativo', 1)->count();

        return $aluguelCarro == 0 ? true : false;
    }

    public function getVeiculoId(): int
    {
        return $this->veiculo_id;
    }

    public function setVeiculoId(int $veiculo_id): void
    {
         $this->veiculo_id = $veiculo_id;
    }

}
