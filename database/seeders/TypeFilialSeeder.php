<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeFilialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Matriz',
                'description' => 'O termo “empresa matriz” se refere ao estabelecimento principal da organização, isto é, o local onde se concentram as principais atividades de rotina, as regras, os regulamentos, as diretrizes e as ideias. É a partir desse núcleo que os gestores definem seus objetivos, suas políticas e seus caminhos corporativos.',
            ],
            [
                'name' => 'Filial',
                'description' => 'Se você já se perguntou o que é filial em uma empresa, precisa saber que filial nada mais é do que a extensão de uma empresa que já existe. Isso quer dizer que ela deve ser gerida e responder a sua matriz. A decisão de abrir uma ou diversas filiais é uma estratégia do empresário.',
            ],
            [
                'name' => 'Franquia',
                'description' => 'Franquia é uma estratégia utilizada em administração que tem, como propósito, um sistema de venda de licença na qual o franqueador cede ao franqueado o direito de uso da sua marca, patente, produtos ou serviços. Abrir uma franquia tem sido comum para pessoas que querem empreender ou ampliar o seu negócio.',
            ],

        ];

        // Inserindo os dados na tabela type_filial
        DB::table('type_filial')->insert($data);
    }
}
