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
            $table->unsignedTinyInteger('id_rol_has_module');
            $table->tinyInteger('r')->default('0');
            $table->tinyInteger('w')->default('0');
            $table->tinyInteger('u')->default('0');
            $table->tinyInteger('d')->default('0');
            $table->timestamps();
            $table->foreign('id_rol_has_module')->references('id')->on('roles_has_modules')->onDelete('cascade');
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
