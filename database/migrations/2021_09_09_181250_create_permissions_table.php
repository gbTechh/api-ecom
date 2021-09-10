<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyIncrements('id')->unsigned();
            $table->unsignedTinyInteger('id_rol');
            $table->unsignedTinyInteger('id_module');
            $table->tinyInteger('r');
            $table->tinyInteger('w');
            $table->tinyInteger('u');
            $table->tinyInteger('d');
            $table->timestamps();
            $table->foreign('id_rol')->references('id')->on('rols')->onDelete('cascade');
            $table->foreign('id_module')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
