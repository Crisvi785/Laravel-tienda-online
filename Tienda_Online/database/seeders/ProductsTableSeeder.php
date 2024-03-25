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
        $imageFolderPath = public_path('static/images/ppimage');

        // Obtener todas las imágenes en la carpeta
        $images = File::allFiles($imageFolderPath);

        // Array para almacenar nombres de imágenes seleccionadas
        $selectedImageNames = [];

        // Crear 8 productos
        for ($i = 1; $i <= 8; $i++) {
            // Seleccionar una imagen aleatoria de la carpeta que no haya sido seleccionada antes
            do {
                $randomImage = $images[array_rand($images)];
                $imageName = basename($randomImage->getPathname());
            } while (in_array($imageName, $selectedImageNames));

            // Agregar el nombre de la imagen a la lista de imágenes seleccionadas
            $selectedImageNames[] = $imageName;

            // Crear el producto
            Products::create([
                'status' => 1,
                'name' => 'Producto ' . $i,
                'slug' => 'producto-' . $i,
                'category_id' => rand(1, 6),
                'image' => $imageName,
                'price' => rand(20, 180), 
                'in_discount' => rand(0, 1), 
                'discount' => rand(5, 50), 
                'content' => 'Descripción del Producto ' . $i,
            ]);
        }
    }
}
