<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Cart is empty.']);
        }
        
        $totalAmount = 0;
        $earnedPoints = 0;
        
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
            $earnedPoints += ($item['reward_points'] ?? 0) * $item['quantity'];
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:1000',
        ]);
        
        $user = auth()->user(); // Will be null for guests
        
        $order = Order::create([
            'user_id' => $user ? $user->id : null,
            'customer_name' => $request->input('name'),
            'customer_phone' => $request->input('phone'),
            'shipping_address' => $request->input('address'),
            'payment_method' => 'COD',
            'total_amount' => $totalAmount,
            'earned_points' => $earnedPoints,
            'status' => 'pending', // Usually pending until delivered
        ]);
        
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
        
        // Add beans to wallet
        if ($user) {
            $user->bean_balance += $earnedPoints;
            $user->save();
        }
        
        // Clear cart
        Session::forget('cart');
        
        return response()->json([
            'success' => true, 
            'message' => 'Order placed successfully!',
            'earned_points' => $earnedPoints
        ]);
    }
}
