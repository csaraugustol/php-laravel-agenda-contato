<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContatosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* DB::table('contatos')->insert([
            'nome' => str_random(10),
            'sobrenome' => str_random(10),
            'user_id' => 1
        ]); */

        factory(App\Contato::class, 25)->create();
    }
}
