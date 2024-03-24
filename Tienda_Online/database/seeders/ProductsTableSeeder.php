<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Models\Products;
use Illuminate\Support\Facades\File;


class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ruta de la carpeta que contiene las imágenes
        $imageFolderPath = 'C:\Users\Cristian\Desktop\Tienda_Online\public\static\images\ppimage';

        // Obtener todas las imágenes en la carpeta
        $images = File::allFiles($imageFolderPath);

        // Crear 8 productos
        for ($i = 1; $i <= 8; $i++) {
            // Seleccionar una imagen aleatoria de la carpeta
            $randomImage = $images[array_rand($images)];

            Products::create([
                'status' => 1,
                'name' => 'Producto ' . $i,
                'slug' => 'producto-' . $i,
                'category_id' => rand(1, 6),
                'image' => $randomImage->getPathname(), 
                'price' => rand(20, 180), 
                'in_discount' => rand(0, 1), 
                'discount' => rand(5, 50), 
                'content' => 'Descripción del Producto ' . $i,
               
            ]);
        }
    }
}
