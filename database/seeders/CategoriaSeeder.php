<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Categoria::create([
            'nombre' => 'Electrónica',
            'descripcion' => 'Dispositivos electrónicos'
        ]);
        
        \App\Models\Categoria::create([
            'nombre' => 'Ropa',
            'descripcion' => 'Prendas de vestir'
        ]);
    }
}
