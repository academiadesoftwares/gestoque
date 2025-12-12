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
