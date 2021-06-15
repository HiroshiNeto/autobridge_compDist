<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Veiculo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;

class ClienteController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $dados   = $request->all();
        $usuario = Usuario::find($dados['usuario_id']);

        $retorno           = new Collection();
        $retorno->mensagem = "Sucesso ao adicionar o Cliente";
        $retorno->status   = 200;
        try{
            if($usuario->funcao->nome != "nenhum"){
                $cliente = new Cliente();
                $cliente->cpf = $dados['cpf'];
                $cliente->nome = $dados['nome'];
                $cliente->save();
            }else{
                $retorno->mensagem = "Usuário não possui permissão de cadastrar novo cliente!";
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id = 0): JsonResponse
    {

        $retorno           = new Collection();
        $retorno->mensagem = "Sucesso";
        $retorno->dados = [];
        $retorno->status   = 200;
        try{
            $cliente = Cliente::all();
            if($id != 0){
                $cliente = Cliente::find($id);
            }
            $retorno->dados = $cliente;
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
        $retorno           = new Collection();
        $retorno->mensagem = "Sucesso ao atualizar o Cliente";
        $retorno->status   = 200;
        try{
            $cliente = Cliente::findOrFail($id);
            $cliente->update($request->all());
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
        $retorno           = new Collection();
        $retorno->mensagem = "Sucesso ao deletar o Cliente";
        $retorno->status   = 200;
        try{
            Cliente::destroy($id);
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
