<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Set;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        //récupération des cartes
        $cards = Card::all();

        //renvoi en json
        return response()->json(
            [
                "data" => $cards
            ]
        );
    }

    public function single($id)
    {
        $card = Card::findOrFail($id);

        return response()->json([
            "card" => $card
        ]);
    }
}
