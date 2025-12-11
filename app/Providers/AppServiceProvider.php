<?php

namespace App\Providers;

use App\Models\ModelCategoria;
use App\Models\ModelEstado;
use App\Models\ModelMarca;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define tamanho padrão das colunas string para evitar erro 1071
        Schema::defaultStringLength(191);

        // Super Admin tem acesso a todas as páginas
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });


        // --------------------------------------------------------------
        // 🔥  VARIÁVEIS GLOBAIS 
        // --------------------------------------------------------------

        View::share('', ModelCategoria::all());
        View::share('ministerios', ModelEstado::all());
        View::share('postos', ModelMarca::all());
        View::share('ramos', ModelCategoria::all());

        // Pode adicionar quantas quiser:
        // View::share('brigadas', ModelBrigadas::all());
        // View::share('celas', ModelCelas::all());
        // View::share('unidades', ModelUnidades::all());
        // ...
    }
}
