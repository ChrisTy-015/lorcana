<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller {
    public function add(Request $request) {
        $request->validate(['card_id' => 'required|exists:cards,id']);
        
        $collection = Collection::create([
            'user_id' => Auth::id(),
            'card_id' => $request->card_id,
        ]);
        
        return response()->json($collection, 201);
    }

    public function remove(Request $request) {
        $request->validate(['id' => 'required|exists:collections,id']);
        
        $collection = Collection::where('id', $request->id)->where('user_id', Auth::id())->firstOrFail();
        $collection->delete();
        
        return response()->json(['message' => 'Collection removed successfully']);
    }

    public function list() {
        $collections = Collection::where('user_id', Auth::id())->get();
        
        return response()->json($collections);
    }
}

