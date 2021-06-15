<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados   = $request->all();
        $usuario = Usuario::find($dados['usuario_id']);

        $retorno           = new Collection();
        $retorno->mensagem = "Sucesso ao adicionar o Veículo";
        $retorno->status   = 200;

        if ($usuario->funcao->nome == "gerente"){
            $veiculo = new Veiculo();
            $veiculo->marca = $dados['marca'];
            $veiculo->modelo = $dados['modelo'];
            $veiculo->chassi = $dados['chassi'];
            $veiculo->save();
        }else{
            $retorno->mensagem = "Usuário não possui permissão de cadastrar novo veículo!";
            $retorno->status   = 401;
        }

        return response()->json([
            'mensagem' => $retorno->mensagem,
            'status'   => $retorno->status
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id = 0): JsonResponse
    {
        $retorno           = new \Illuminate\Support\Collection();
        $retorno->mensagem = "Sucesso";
        $retorno->dados = [];
        $retorno->status   = 200;
        try{
            $veiculo = Veiculo::all();
            if($id != 0){
                $veiculo = Veiculo::find($id);
            }
            $retorno->dados = $veiculo;
        }catch(Exception $e){
            $retorno->mensagem = $e->getMessage();
            $retorno->status = $e->getCode();
            $retorno->dados = [];
        }

        return response()->json([
            'mensagem' => $retorno->mensagem,
            'status'   => $retorno->status,
            'dados'   => $retorno->dados
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $retorno           = new \Illuminate\Support\Collection();
        $retorno->mensagem = "Sucesso ao atualizar o Veículo";
        $retorno->status   = 200;
        try{
            $veiculo = Veiculo::findOrFail($id);
            $veiculo->update($request->all());
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
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): JsonResponse
    {
        $retorno           = new \Illuminate\Support\Collection();
        $retorno->mensagem = "Sucesso ao deletar o Veículo";
        $retorno->status   = 200;
        try{
            Veiculo::destroy($id);
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
