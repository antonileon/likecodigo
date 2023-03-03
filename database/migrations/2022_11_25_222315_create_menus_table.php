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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nombre',120);
            $table->string('descripcion',120);
            $table->string('ruta',120)->nullable();
            $table->string('url',120)->nullable();
            $table->string('icono',120);
            $table->integer('orden');
            $table->enum('status', [0,1])->default(1);
            $table->string('permiso',120)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
