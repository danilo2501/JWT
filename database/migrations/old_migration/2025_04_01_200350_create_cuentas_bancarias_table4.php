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
        Schema::create('cuentas_bancarias_table4', function (Blueprint $table) {
            $table->integerIncrements('id_cuenta');
            $table->string('nombre_titular');
            $table->text('descripcion');
            $table->decimal('saldo',15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_bancarias_table4');
    }
};
