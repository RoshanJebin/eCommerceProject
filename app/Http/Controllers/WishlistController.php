<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function toggleWishlist(Request $request)
    {
        $user_id = Auth::user()->id;
        $product_id = $request->product_id;

        // Check if the entry already exists
        $existingWishlist = Wishlist::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingWishlist) {
            // If the entry already exists, delete it
            $existingWishlist->delete();
            $itemInWishlist = false;
            return response()->json(['message' => 'Item removed from wishlist', 'itemInWishlist' => $itemInWishlist]);
        }

        // If the entry does not exist, create it
        $data = [
            'user_id' => $user_id,
            'product_id' => $product_id,
        ];

        Wishlist::create($data);
        $itemInWishlist = true;
        return response()->json(['message' => 'Item added to wishlist', 'itemInWishlist' => $itemInWishlist]);
    }
}
