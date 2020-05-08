<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColaboradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaborador', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('dni', 8)->unique();
            $table->string('nombre',255);
            $table->string('apellidos',255);
            $table->string('correoElectronico',255);
            $table->text('urlFoto');
            $table->date('fechaNacimiento');
            $table->unsignedBigInteger('ocupacionId');
        
            $table->timestampsTz();
            $table->softDeletesTz();   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colaborador');
    }
}
