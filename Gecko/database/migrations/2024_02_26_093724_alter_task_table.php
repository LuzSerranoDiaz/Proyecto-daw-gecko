<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('task', function (Blueprint $table){
        //     $table->unsignedBigInteger('user_id');
        //     $table->foreign('user_id')->references('id')->on('user');
        // });
        // Por ahora no hago la clave foranea para que no de problemas por si tengo que borrarlo
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
};
