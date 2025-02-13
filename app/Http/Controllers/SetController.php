<?php

namespace App\Http\Controllers;

use App\Models\Set;
use App\Models\Card;
use Illuminate\Http\Request;

class SetController extends Controller
{
    // Récupérer tous les sets
    public function index()
    {
        return response()->json(Set::all(), 200);
    }

    // Récupérer un set spécifique par ID
    public function single($id)
    {
        $set = Set::find($id);

        if (!$set) {
            return response()->json(['message' => 'Set non trouvé'], 404);
        }

        return response()->json($set, 200);
    }

    // Récupérer les cartes d’un set spécifique
    public function cards($id)
    {
        $set = Set::find($id);

        if (!$set) {
            return response()->json(['message' => 'Set non trouvé'], 404);
        }

        $cards = Card::where('set_id', $id)->get();

        return response()->json($cards, 200);
    }
}
