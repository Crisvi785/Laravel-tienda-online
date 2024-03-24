<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Accesories',
            'Outwear',
            'T-shirts',
            'Hoodies',
            'Crewnecks',
            'Polos',
        ];

        // Iterar sobre las categorías y crearlas en la base de datos
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                // Puedes agregar más campos si es necesario
            ]);
        }
    }
}
