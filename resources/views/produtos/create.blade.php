@extends('layouts.admin')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <h2 class="content-title">Novo Produto</h2>
        <nav class="breadcrumb">
            <a href="{{ route('dashboard.index') }}" class="breadcrumb-link">Dashboard</a>
            <span>/</span>
            <a href="#" class="breadcrumb-link">Produtos</a>
            <span>/</span>
            <span>Produto</span>
        </nav>
    </div>
</div>

<div class="content-box">
    <div class="content-box-header">
        <h3 class="content-box-title">Cadastrar</h3>
        <div class="content-box-btn">
            @can('index-produto')
            <a href="{{ route('produtos.index') }}" class="btn-info align-icon-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
                <span>Listar</span>
            </a>
            @endcan
        </div>
    </div>

    <x-alert />

    <div class="w-full">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <form method="POST" action="{{ route('produto.store') }}">
                    @csrf
                    @method('POST')
                    <div class="p-5 bg-white rounded-md shadow-sm space-y-8">

                        <!-- GRID PRINCIPAL -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                            <div>
                                <label class="label-personalized">Designação</label>
                                <input type="text" name="descricao_produto" class="form-personalized" placeholder="Digite o nome do produto">
                            </div>

                            <div>
                                <label class="label-personalized">Categoria</label>
                                <select id="categoriaSelect" name="" class="form-personalized">
                                    <option value="" selected disabled>Selecione</option>
                                    @foreach($list_categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->designacao_categoria }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="label-personalized">Marca</label>
                                <select id="marcaSelect" name="marca_id" class="form-personalized">
                                    <option value="" selected disabled>Selecione uma categoria primeiro</option>
                                    @foreach($list_marcas as $marca)
                                    <option value="{{ $marca->id }}" data-categoria="{{ $marca->categoria_id }}" style="display:none;">
                                        {{ $marca->designacao_marca }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="label-personalized">Preço</label>
                                <input type="text" name="preco_kwanza" class="form-personalized preco_kwanza" placeholder="KZ$ 0,00">
                            </div>
                        </div>

                        <!-- GRID QUANTIDADE + ESTADO GERAL + CHECKBOX -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 items-end">

                            <div id="quantidadeBox">
                                <label for="quantidade_prod" class="label-personalized">Quantidade</label>
                                <input type="number" min="1" name="quantidade_prod" class="form-personalized" placeholder="Ex: 5">
                            </div>

                            <div id="estadoGeralBox">
                                <label class="label-personalized">Estado</label>
                                <select name="estado_produto" class="form-personalized">
                                    <option value="" selected disabled>Selecione</option>
                                    @foreach($list_estados as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->designacao_estado }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Checkbox ocupa linha inteira em telas pequenas -->
                            <div class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4 flex items-center gap-3">
                                <label class="flex items-center space-x-3">
                                    <input type="checkbox" id="hasSeriesCheckbox" name="has_series" value="1">
                                    <span>Este produto tem número de série?</span>
                                </label>
                            </div>
                        </div>

                        <!-- GRID SÉRIE + ESTADO POR SÉRIE -->
                        <div id="boxSerie" style="display:none;" class="space-y-5">

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 items-end">

                                <div>
                                    <label class="label-personalized">Nº de Série</label>
                                    <input type="text" id="inputSerie" class="form-personalized" placeholder="Digite a série">
                                </div>

                                <div>
                                    <label class="label-personalized">Estado</label>
                                    <select id="inputEstadoSerie" class="form-personalized">
                                        <option value="" selected disabled>Selecione</option>
                                        @foreach($list_estados as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->designacao_estado }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex sm:col-span-2 md:col-span-1">
                                    <button type="button" id="btnAddSerie"
                                        class="px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white rounded w-full sm:w-auto mt-6">
                                        +
                                    </button>
                                </div>
                            </div>

                            <!-- TABELA -->
                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse text-left">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="p-2">#</th>
                                            <th class="p-2">Número de Série</th>
                                            <th class="p-2">Estado</th>
                                            <th class="p-2">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="seriesTableBody"></tbody>
                                </table>
                            </div>

                            <input type="hidden" name="series_json" id="seriesJson">
                        </div>

                        <!-- BOTÃO FINAL -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded">
                                Salvar
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>

</script>


@endsection



<select id="categoriaSelect" name="" class="form-personalized">
if ($produto > 0) {
    ModelProdutoSerie::created([
        'produto_id' => $request->produto_id,
        'numero_serie' => $request->seriesJson,
    ]);
}
namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\ModelProduto;
use App\Models\ModelProdutoSerie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    public function create()
    {
        return view('produtos.create', ['menu' => 'produtos']);
    }

    public function store(ProdutoRequest $request)
    {
        try {
            // Salvar o produto
            $produto = ModelProduto::create([
                'designacao_produto' => $request->descricao_produto,
                'preco_produto'      => $request->preco_kwanza,
                'quantidade_produto' => $request->quantidade_prod,
                'categoria_id'       => $request->categoria_id,
                'marca_id'           => $request->marca_id,
                'estado_id'          => $request->estado_produto,
            ]);

            // Salvar séries do produto, se existirem
            if ($request->has_series && $request->series_json) {
                $seriesList = json_decode($request->series_json, true);
                foreach ($seriesList as $serie) {
                    ModelProdutoSerie::create([
                        'produto_id'    => $produto->id,
                        'numero_serie'  => $serie['serie'],
                        'estado_id'     => $serie['estado'], // se tiver relação com estado
                        'status'        => true,
                    ]);
                }
            }

            Log::info('Produto cadastrado.', [
                'produto_id' => $produto->id,
                'user_id'    => Auth::id()
            ]);

            return redirect()->route('produtos.show', $produto->id)
                             ->with('success', 'Produto cadastrado com sucesso!');

        } catch (\Throwable $th) {
            Log::error('Erro ao cadastrar produto', ['error' => $th->getMessage()]);
            return back()->withErrors('Erro ao cadastrar produto. Tente novamente.');
        }
    }
}
<select id="categoriaSelect" name="categoria_id" class="form-personalized">
    <option value="" selected disabled>Selecione</option>
    @foreach($list_categorias as $categoria)
        <option value="{{ $categoria->id }}">{{ $categoria->designacao_categoria }}</option>
    @endforeach
</select>
<input type="number" min="1" name="quantidade_prod" class="form-personalized" placeholder="Ex: 5">
<select name="estado_produto" class="form-personalized">
    <option value="" selected disabled>Selecione</option>
    @foreach($list_estados as $estado)
        <option value="{{ $estado->id }}">{{ $estado->designacao_estado }}</option>
    @endforeach
</select>
public function rules()
{
    return [
        'descricao_produto' => 'required|string|max:255',
        'preco_kwanza'      => 'required|numeric',
        'quantidade_prod'   => 'required|integer|min:1',
        'categoria_id'      => 'required|exists:tb_categorias,id',
        'marca_id'          => 'required|exists:tb_marcas,id',
        'estado_produto'    => 'required|exists:tb_estados,id',
    ];
}
