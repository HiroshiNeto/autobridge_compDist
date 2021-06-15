<?php

namespace App\Http\Controllers;

use App\Models\AluguelCarro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Veiculo;
use Illuminate\Support\Collection;


class AluguelCarroController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createRentCar(Request $request): JsonResponse
    {
        $dados   = $request->all();
        $usuario = Usuario::find($dados['usuario_id']);

        $retorno           = new Collection();
        $retorno->mensagem = "Veículo não disponivel";
        $retorno->status   = 200;
        try{
            if($usuario->funcao->nome != "nenhum"){

                $aluguel = new AluguelCarro();
                $aluguel->setVeiculoId($dados['veiculo_id']);
                $aluguelDisponivel = $aluguel->veiculoDisponivelParaAluguel();

                if($aluguelDisponivel){
                    $aluguel->usuario_id = $dados['usuario_id'];
                    $aluguel->veiculo_id = $dados['veiculo_id'];
                    $aluguel->cliente_id = $dados['cliente_id'];
                    $aluguel->save();

                    $retorno->mensagem = "Sucesso ao alugar um Veículo";
                    $retorno->status   = 200;
                }

            }else{
                $retorno->mensagem = "Usuário não possui permissão de alugar um veículo!";
                $retorno->status   = 401;
            }

        }catch(Exception $e){
            $retorno->mensagem = $e->getMessage();
            $retorno->status = $e->getCode();
        }

        return response()->json([
            'mensagem' => $retorno->mensagem,
            'status'   => $retorno->status
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  int $veiculo_id
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function returnCar(Request $request, int $veiculo_id): JsonResponse
    {
        $dados   = $request->all();
        $usuario = Usuario::find($dados['usuario_id']);

        $retorno           = new Collection();
        $retorno->mensagem = "";
        $retorno->status   = 200;
        try{
            if($usuario->funcao->nome != "nenhum"){
                $aluguel = AluguelCarro::findOrFail($veiculo_id);
                $aluguel->ativo = 0;
                $aluguel->save();

                $retorno->mensagem = "Sucesso ao devolver um Veículo";
                $retorno->status   = 200;

            }else{
                $retorno->mensagem = "Usuário não possui permissão de devolver um veículo!";
                $retorno->status   = 401;
            }

        }catch(Exception $e){
            $retorno->mensagem = $e->getMessage();
            $retorno->status = $e->getCode();
        }

        return response()->json([
            'mensagem' => $retorno->mensagem,
            'status'   => $retorno->status
        ]);
    }
}
