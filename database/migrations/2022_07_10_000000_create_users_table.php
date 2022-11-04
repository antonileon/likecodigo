<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')
                    ->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('tipo_usuario_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->string('email',200)->unique();
            $table->string('nombre_usuario',200)->unique();
            $table->string('slug',255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status',['Activo','Inactivo'])->default('Activo');
            $table->enum('tema',[0,1])->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
