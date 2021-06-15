<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use http\Client\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;


class UsuarioController extends Controller
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

        $retorno           = new Collection();
        $retorno->mensagem = "Sucesso ao adicionar o Usuário";
        $retorno->status   = 200;
        try{
            $usuario = new Usuario();
            $usuario->cpf = $dados['cpf'];
            $usuario->nome = $dados['nome'];
            $usuario->login = $dados['login'];
            $usuario->password = $dados['password'];
            $usuario->funcao_id = $dados['funcao_id'];
            $usuario->save();
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
            $usuario = Usuario::all();
            if($id != 0){
                $usuario = Usuario::find($id);
            }
            $retorno->dados = $usuario;
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
        $retorno->mensagem = "Sucesso ao atualizar o Usuário";
        $retorno->status   = 200;
        try{
            $usuario = Usuario::findOrFail($id);
            $usuario->update($request->all());
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
        $retorno->mensagem = "Sucesso ao deletar o Usuario";
        $retorno->status   = 200;
        try{
            Usuario::destroy($id);
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
