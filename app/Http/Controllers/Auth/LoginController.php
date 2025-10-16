<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm(Request $request)
    {
        // Store redirect parameters in session
        if ($request->has('redirect') && $request->has('product_id')) {
            session([
                'add_to_cart_after_login' => [
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity ?? 1
                ]
            ]);
        }

        return view('auth.login');
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Check if user wants to add product to cart after login
            if (session()->has('add_to_cart_after_login')) {
                $cartData = session('add_to_cart_after_login');
                session()->forget('add_to_cart_after_login');
                
                // Get product slug
                $product = \App\Models\Product::find($cartData['product_id']);
                if ($product) {
                    return redirect()->route('products.show', $product->slug)
                        ->with('success', 'Please add the product to your cart.');
                }
            }

            return redirect()->intended(route('home'));
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
