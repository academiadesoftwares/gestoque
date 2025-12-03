<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    //

    // Carregar o formulário cadastrar 
    public function create()
    {
        // Carregar a view 
        return view('produtos.create', ['menu' => 'produtos']);
    }
}
