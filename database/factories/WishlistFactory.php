<?php

namespace Database\Factories;

use App\Models\Wishlist;
use App\Models\User;
use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishlistFactory extends Factory
{
    protected $model = Wishlist::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'card_id' => Card::factory()
        ];
    }
}
