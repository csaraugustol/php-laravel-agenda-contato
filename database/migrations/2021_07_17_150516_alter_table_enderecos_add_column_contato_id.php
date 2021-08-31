<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableEnderecosAddColumnContatoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->unsignedInteger('contato_id')->after('id');
            $table->foreign('contato_id')->references('id')->on('contatos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropForeign('enderecos_contato_id_foreign');
            $table->dropColumn('contato_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
