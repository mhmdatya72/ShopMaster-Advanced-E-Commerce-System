<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class MergeGuestCartOnLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $sessionId = session()->getId();

        // Find guest cart (where user_id is null and session_id matches)
        $guestCart = Cart::whereNull('user_id')
            ->where('session_id', $sessionId)
            ->first();

        if (!$guestCart) {
            return; // No guest cart to merge
        }

        // Find or create user cart
        $userCart = Cart::where('user_id', $user->id)->first();

        if (!$userCart) {
            // Create new cart for user
            $userCart = Cart::create([
                'user_id' => $user->id,
                'session_id' => $sessionId,
            ]);
        }

        // Get guest cart items
        $guestCartItems = $guestCart->items;

        foreach ($guestCartItems as $guestItem) {
            // Check if user already has this product in cart
            $existingItem = $userCart->items()
                ->where('product_id', $guestItem->product_id)
                ->first();

            if ($existingItem) {
                // Sum quantities if same product
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $guestItem->quantity,
                ]);
            } else {
                // Add new item to user cart
                $userCart->items()->create([
                    'product_id' => $guestItem->product_id,
                    'quantity' => $guestItem->quantity,
                    'price' => $guestItem->price,
                    'unit_price' => $guestItem->unit_price ?? $guestItem->price,
                ]);
            }
        }

        // Delete guest cart and its items
        $guestCart->items()->delete();
        $guestCart->delete();
    }
}
