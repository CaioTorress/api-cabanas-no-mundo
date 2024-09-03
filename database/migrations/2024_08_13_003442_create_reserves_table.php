<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->string('hospede',100);
            $table->string('chale',100);
            $table->string('dataEntrada',100);
            $table->string('dataSaida',100);
            $table->string('origemReserva',100);
            $table->string('valorTotal',100);
            $table->string('valorPago',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserves');
    }
};
