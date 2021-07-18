<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableTelefonesAddColumnContatoId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('telefones', function (Blueprint $table) {
            $table->unsignedInteger('contato_id')->after('id');
            $table->foreign('contato_id')->references('id')->on('contatos')->onDelete("cascade");
           // $table->foreign("post_id")->references("id")->on("posts");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('telefones', function (Blueprint $table) {
            $table->dropForeign('telefones_contato_id_foreign');
            $table->dropColumn('contato_id');
        });
    }
}
