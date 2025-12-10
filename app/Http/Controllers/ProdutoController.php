<?php

namespace App\Http\Controllers;

use App\Models\ModelProduto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Termwind\Components\Dd;

class ProdutoController extends Controller
{
    //

    // Carregar o formulário cadastrar 
    public function create()
    {
        // Carregar a view 
        return view('produtos.create', ['menu' => 'produtos']);
    }

    public function store(Request $request)
    {
        dd($request);
        exit;
        // Capturar possíveis exceções durante a execução.
        try {
            // Cadastrar no banco de dados na tabela
            $produto = ModelProduto::create(
                [
                    "designacao_produto" => $request->designacao,
                    "descricao_produto" => $request->descricao,
                    "preco_produto" => $request->preco,
                    "quantidade_estoque" => $request->quantidade
                ]
            );

            // Salvar log
            Log::info('Produto cadastrado.', ['produto_id' => $produto->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('produtos.show', ['Produto' => $produto->id])->with('success', 'Produto cadastrado com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
