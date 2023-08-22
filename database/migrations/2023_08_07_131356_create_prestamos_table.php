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
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->integer('cliente_dni');
            $table->double('monto_prestado');
            $table->double('monto_ha_pagar');
            $table->integer('cuotas');
            $table->double('interes');
            $table->date('fecha');
            $table->integer('user_id');
            $table->boolean('pagado')->default(false);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
