<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Ajouter une carte à la wishlist
    public function add(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:cards,id'
        ]);

        $wishlist = Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'card_id' => $request->card_id
        ]);

        return response()->json(['message' => 'Carte ajoutée à la wishlist'], 201);
    }

    // Supprimer une carte de la wishlist
    public function remove(Request $request)
    {
        $request->validate([
            'card_id' => 'required|exists:cards,id'
        ]);

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('card_id', $request->card_id)
            ->first();

        if (!$wishlist) {
            return response()->json(['message' => 'Carte non trouvée dans la wishlist'], 404);
        }

        $wishlist->delete();

        return response()->json(['message' => 'Carte retirée de la wishlist'], 200);
    }

    // Lister les cartes de la wishlist
    public function list()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->with('card')->get();
        return response()->json($wishlist, 200);
    }
}
