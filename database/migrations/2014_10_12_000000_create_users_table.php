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
            $table->increments('id')->nullable(false);
            $table->string('nome', 50);
            $table->string('cpf_cnpj', 14)->unique();
            $table->string('email', 30)->unique();
            $table->string('senha', 100);
            $table->string('tipo', 2);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('cashs', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->nullable(false)->references('id')->on('users');
            $table->decimal('cash', 9, 2);
        });

        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id')->nullable(false);
            $table->integer('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
            $table->integer('idTargetUser')->unsigned();
            $table->foreign('idTargetUser')->references('id')->on('users');
            $table->decimal('cash', 9, 2);
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
        Schema::dropIfExists('cashs');
        Schema::dropIfExists('transfers');
    }
}
