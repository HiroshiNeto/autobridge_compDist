<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertFuncoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('funcoes')->insert([
            'nome' => 'gerente'
        ]);
        DB::table('funcoes')->insert([
            'nome' => 'vendedor'
        ]);
        DB::table('funcoes')->insert([
            'nome' => 'nenhum'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
