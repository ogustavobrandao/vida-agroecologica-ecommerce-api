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
        Schema::create('bairro_banca', function (Blueprint $table) {
            $table->id();

            $table->decimal('taxa')->nullable();
            $table->boolean('faz_entrega');

            $table->foreignId('bairro_id')->constrained()->restrictOnDelete();
            $table->foreignId('banca_id')->constrained()->cascadeOnDelete();

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
        Schema::dropIfExists('bairro_banca');
    }
};
