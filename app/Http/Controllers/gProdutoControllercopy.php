<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\ModelProduto;
use App\Models\ModelProdutoSerie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Termwind\Components\Dd;

class ProdutoController extends Controller
{
    // Carregar o formulário cadastrar 
    public function create()
    {
        // Carregar a view 
        return view('produtos.create', ['menu' => 'produtos']);
    }

    public function store(ProdutoRequest $request)
    {
        dd($request);
        exit;
        // Capturar possíveis exceções durante a execução.
        try {
            // Cadastrar no banco de dados na tabela produto
            $produto = ModelProduto::create(
                [
                    "designacao_produto" => $request->descricao_produto,
                    "preco_produto" => $request->preco_kwanza,
                    "quantidade_produto" => $request->quantidade_prod,

                    "marca_id" => $request->marca_id,
                    "estado_id" => $request->estado_produto,
                ]
            );


            // Cadastrar no BD na tabela produto as series do produto
            if ($produto > 0) {
                ModelProdutoSerie::created([
                    'produto_id' => $request->produto_id,
                    'numero_serie' => $request->seriesJson,
                ]);
            }

            // Salvar log
            Log::info('Produto cadastrado.', ['produto_id' => $produto->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('produtos.show', ['Produto' => $produto->id])->with('success', 'Produto cadastrado com sucesso!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
