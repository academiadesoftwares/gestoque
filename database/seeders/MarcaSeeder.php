<?php

namespace Database\Seeders;

use App\Models\ModelMarca;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Registrar marcas, evitando duplicidade
            ModelMarca::firstOrCreate(
                ['designacao_marca' => 'Samsung'], // coluna que define a unicidade
                [
                    'descricao' => 'Marca de eletrônicos coreana',
                    'status' => true
                ]
            );

            ModelMarca::firstOrCreate(
                ['designacao_marca' => 'Nike'],
                [
                    'descricao' => 'Marca de artigos esportivos',
                    'status' => true
                ]
            );

            ModelMarca::firstOrCreate(
                ['designacao_marca' => 'Apple'],
                [
                    'descricao' => 'Marca de eletrônicos e smartphones',
                    'status' => true
                ]
            );
        } catch (Exception $e) {
            Log::notice('Marca não cadastrada.', ['error' => $e->getMessage()]);
        }
    }
}
