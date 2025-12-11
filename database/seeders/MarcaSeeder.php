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
            );

            ModelMarca::firstOrCreate(
                ['designacao_marca' => 'Apple'], // coluna que define a unicidade        
            );
            ModelMarca::firstOrCreate(
                ['designacao_marca' => 'Sony'], // coluna que define a unicidade           
            );
            ModelMarca::firstOrCreate(
                ['designacao_marca' => 'LG'], // coluna que define a unicidade
            
            );
            ModelMarca::firstOrCreate(
                ['designacao_marca' => 'Panasonic'], // coluna que define a unicidade
            );
            ModelMarca::firstOrCreate(
                ['designacao_marca' => 'Xiaomi'], // coluna que define a unicidade
            );

            ModelMarca::firstOrCreate(
                ['designacao_marca' => 'Nike'],
            );

            ModelMarca::firstOrCreate(
                ['designacao_marca' => 'Apple'],
            );
        } catch (Exception $e) {
            Log::notice('Marca não cadastrada.', ['error' => $e->getMessage()]);
        }
    }
}
