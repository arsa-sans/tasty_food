<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $foods = [
            // Tentang section (4 items - matching home page cards)
            ['name' => 'Salad Segar', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo pretium hendrerit.', 'image' => 'assets/anna-pelzer-IGfIGP5ONV0-unsplash.jpg', 'section' => 'tentang'],
            ['name' => 'Smoothie Bowl', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo pretium hendrerit.', 'image' => 'assets/brooke-lark-nBtmglfY0HU-unsplash.jpg', 'section' => 'tentang'],
            ['name' => 'Veggie Bowl', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo pretium hendrerit.', 'image' => 'assets/ella-olsson-mmnKI8kMxpc-unsplash.jpg', 'section' => 'tentang'],
            ['name' => 'Acai Bowl', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo pretium hendrerit.', 'image' => 'assets/eiliv-aceron-ZuIDLSz3XLg-unsplash.jpg', 'section' => 'tentang'],

            // Berita section (5 items - matching news layout)
            ['name' => 'Masakan Rumahan', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet. Maecenas sed dui nec ligula faucibus tempus.', 'image' => 'assets/jimmy-dean-Jvw3pxgeiZw-unsplash.jpg', 'section' => 'berita'],
            ['name' => 'Healthy Breakfast', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet.', 'image' => 'assets/brooke-lark-oaz0raysASk-unsplash.jpg', 'section' => 'berita'],
            ['name' => 'Street Food', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet.', 'image' => 'assets/fathul-abrar-T-qI_MI2EMA-unsplash.jpg', 'section' => 'berita'],
            ['name' => 'Fresh Cooking', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet.', 'image' => 'assets/monika-grabkowska-P1aohbiT-EY-unsplash.jpg', 'section' => 'berita'],
            ['name' => 'Dessert Special', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non nisl ut eros fermentum aliquet.', 'image' => 'assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg', 'section' => 'berita'],

            // Galeri section (8 items - matching gallery grid)
            ['name' => 'Salad Bowl', 'description' => 'Fresh and colorful salad bowl.', 'image' => 'assets/brooke-lark-1Rm9GLHV0UA-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Ramen Bowl', 'description' => 'Warm and delicious ramen.', 'image' => 'assets/anh-nguyen-kcA-c3f_3FE-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Gourmet Plate', 'description' => 'Beautifully plated gourmet dish.', 'image' => 'assets/jonathan-borba-Gkc_xM3VY34-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Indian Cuisine', 'description' => 'Traditional Indian cuisine.', 'image' => 'assets/sanket-shah-SVA7TyHxojY-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Coffee Break', 'description' => 'Perfect morning coffee break.', 'image' => 'assets/michele-blackwell-rAyCBQTH7ws-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Breakfast Spread', 'description' => 'Full breakfast spread.', 'image' => 'assets/brooke-lark-nBtmglfY0HU-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Tropical Fruits', 'description' => 'Fresh tropical fruits.', 'image' => 'assets/luisa-brimble-HvXEbkcXjSk-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Mediterranean', 'description' => 'Mediterranean inspired dish.', 'image' => 'assets/mariana-medvedeva-iNwCO9ycBlc-unsplash.jpg', 'section' => 'galeri'],
        ];

        foreach ($foods as $food) {
            Food::create(array_merge($food, ['is_active' => true]));
        }
    }
}
