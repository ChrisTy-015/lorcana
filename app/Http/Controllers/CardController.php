<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    // Récupérer toutes les cartes
    public function index()
    {
        return response()->json(Card::all(), 200);
    }

    // Récupérer une seule carte par ID
    public function single($id)
    {
        $card = Card::find($id);
        
        if (!$card) {
            return response()->json(['message' => 'Carte non trouvée'], 404);
        }

        return response()->json($card, 200);
    }
}
