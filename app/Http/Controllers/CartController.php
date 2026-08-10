<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);
        $cart = Session::get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'reward_points' => $product->reward_points,
                'quantity' => 1,
                'attributes' => [
                    'image' => $product->image,
                    'reward_points' => $product->reward_points
                ] // Keep backwards compatibility with attributes structure
            ];
        }
        
        Session::put('cart', $cart);
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, $request->input('quantity', 1));
            Session::put('cart', $cart);
        }
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function remove(Request $request, $id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function data()
    {
        $cart = Session::get('cart', []);
        
        // Ensure all image paths in the cart have the full asset URL for subfolder deployments
        foreach ($cart as $id => &$item) {
            if (isset($item['image']) && !str_starts_with($item['image'], 'http')) {
                $item['image'] = asset(ltrim($item['image'], '/'));
            }
        }
        unset($item);

        return response()->json($cart);
    }
}
