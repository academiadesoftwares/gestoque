<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Capturar possíveis exceções durante a execução do seeder. 
        try {
            // Verificar se o usuário está cadastrado no banco de dados
            if (!User::where('email', 'cesar@celke.com.br')->first()) {
                // Cadastrar o usuário
                $superAdmin = User::create([
                    'name' => 'Cesar',
                    'email' => 'cesar@celke.com.br',
                    'password' => '123456A#',
                ]);

                // Atribuir papel para o usuário
                $superAdmin->assignRole('Super Admin');
            }

            if (App::environment() !== 'production') {
                // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                $admin = User::firstOrCreate(
                    ['email' => 'kelly@celke.com.br'],
                    ['name' => 'Kelly', 'email' => 'kelly@celke.com.br', 'password' => '123456A#'],
                );

                // Atribuir papel para o usuário
                $admin->assignRole('Admin');

                // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                $teacher = User::firstOrCreate(
                    ['email' => 'jessica@celke.com.br'],
                    ['name' => 'Jessica', 'email' => 'jessica@celke.com.br', 'password' => '123456A#'],
                );

                // Atribuir papel para o usuário
                $teacher->assignRole('Professor');
                // $teacher->assignRole('Aluno');

                // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                $tutor = User::firstOrCreate(
                    ['email' => 'gabrielly@celke.com.br'],
                    ['name' => 'Gabrielly', 'email' => 'gabrielly@celke.com.br', 'password' => '123456A#'],
                );

                // Atribuir papel para o usuário
                $tutor->assignRole('Tutor');

                // Se não encontrar o registro com o e-mail, cadastra o registro no BD
                $student = User::firstOrCreate(
                    ['email' => 'ana@celke.com.br'],
                    ['name' => 'Ana', 'email' => 'ana@celke.com.br', 'password' => '123456A#'],
                );

                // Atribuir papel para o usuário
                $student->assignRole('Aluno');

                // Gerar nomes e e-mails aleatórios
                $faker = Faker::create();

                // Data de início (1 ano e 3 meses atrás)
                $startDate = Carbon::now()->subMonthsNoOverflow(15)->startOfMinute();

                // Data de fim (agora)
                $endDate = Carbon::now()->startOfMinute();

                // Número de usuários
                $totalUsers = 20;

                // Calcular o total de segundos entre as datas
                $totalSeconds = $endDate->timestamp - $startDate->timestamp;

                // Cadastrar usuários com papel "Aluno"
                for ($i = 0; $i < $totalUsers; $i++) {
                    // Distribuição progressiva (crescimento quadrático)
                    $progress = 1 - pow(($totalUsers - 1 - $i) / ($totalUsers - 1), 2);
                    //$progress = pow($i / ($totalUsers - 1), 2); // vai de 0 até 1 (quadraticamente)
                    $secondsToAdd = (int) round($progress * $totalSeconds);

                    // Criar a data progressiva crescente
                    $createdAt = (clone $startDate)->addSeconds($secondsToAdd);

                    $user = User::create([
                        'name' => $faker->name,
                        'email' => $faker->unique()->safeEmail, // Garantir que cada e-mail seja único.
                        'password' => '123456A#', // Caso seja necessário forçar a criptografia da senha 'password' => bcrypt('123456A#'),
                        'created_at' => $createdAt,
                        'updated_at' => $createdAt,
                    ]);
                    $user->assignRole('Aluno');
                }

            }
        } catch (Exception $e) {
            // Salvar log
            Log::notice('Usuário não cadastrado.', ['error' => $e->getMessage()]);
        }
    }
}
