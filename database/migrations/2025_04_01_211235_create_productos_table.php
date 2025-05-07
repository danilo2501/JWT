<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            // Primary key debe definirse PRIMERO
            $table->id(); // Laravel usa 'id' por defecto (BIGINT unsigned)
            
            // Llave foránea corregida
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('cascade');
            
            // Resto de campos
            $table->string('nombre', 50); // Aumenté el límite de 20 a 50 caracteres
            $table->decimal('precio', 10, 2); // Mejor que double para dinero
            $table->integer('stock')->default(0);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};