<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Set;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Création de 10 users random
        User::factory(10)->create();

        //Création de l'utilisateur brybry
        User::factory()->create([
            "email" => "bryan@agence-webup.com",
            "password" => "test",
            "name" => "Brybry",
        ]);

        //Création des sets avec 100 cartes associées
        Set::factory(6)
            ->has(Card::factory()->count(100))
            ->create();
    }
}
