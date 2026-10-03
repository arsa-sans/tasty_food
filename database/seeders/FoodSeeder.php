<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        Food::truncate();

        $foods = [
            // Tentang section (4 items - exactly matching Home Page floating cards)
            ['name' => 'LOREM IPSUM', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo.', 'image' => 'assets/img-1.png', 'section' => 'tentang'],
            ['name' => 'LOREM IPSUM', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo.', 'image' => 'assets/img-2.png', 'section' => 'tentang'],
            ['name' => 'LOREM IPSUM', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo.', 'image' => 'assets/img-3.png', 'section' => 'tentang'],
            ['name' => 'LOREM IPSUM', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo.', 'image' => 'assets/img-4-2000x2000.png', 'section' => 'tentang'],

            // Berita section (5 items - matching news layout)
            ['name' => 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo, dui diam convallis arcu, eget dictum mi enim eget mauris. Donec interdum, lectus sed sollicitudin lobortis, arcu sapien imperdiet libero.', 'image' => 'assets/jimmy-dean-Jvw3pxgeiZw-unsplash.jpg', 'section' => 'berita'],
            ['name' => 'LOREM IPSUM', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo.', 'image' => 'assets/brooke-lark-oaz0raysASk-unsplash.jpg', 'section' => 'berita'],
            ['name' => 'LOREM IPSUM', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo.', 'image' => 'assets/michele-blackwell-rAyCBQTH7ws-unsplash.jpg', 'section' => 'berita'],
            ['name' => 'LOREM IPSUM', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo.', 'image' => 'assets/fathul-abrar-T-qI_MI2EMA-unsplash.jpg', 'section' => 'berita'],
            ['name' => 'LOREM IPSUM', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mattis metus vitae leo.', 'image' => 'assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.jpg', 'section' => 'berita'],

            // Galeri section (matching gallery grid)
            ['name' => 'Salad Bowl', 'description' => 'Fresh and colorful salad bowl.', 'image' => 'assets/brooke-lark-1Rm9GLHV0UA-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Salmon Dish', 'description' => 'Salmon fillet on bright citrus bed.', 'image' => 'assets/img-4.png', 'section' => 'galeri'],
            ['name' => 'Dark Salad Bowl', 'description' => 'Healthy green salad with lemon and fork.', 'image' => 'assets/anh-nguyen-kcA-c3f_3FE-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Noodle Bowl', 'description' => 'Asian noodles with chopsticks and herbs.', 'image' => 'assets/ella-olsson-mmnKI8kMxpc-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Tomato Toast', 'description' => 'Rustic bread with tomatoes and herb spread.', 'image' => 'assets/mariana-medvedeva-iNwCO9ycBlc-unsplash.jpg', 'section' => 'galeri'],
            ['name' => 'Pancake Pan', 'description' => 'Skillet pancake with blueberries and chocolate.', 'image' => 'assets/Group 70.png', 'section' => 'galeri'],
        ];

        foreach ($foods as $food) {
            Food::create(array_merge($food, ['is_active' => true]));
        }
    }
}
