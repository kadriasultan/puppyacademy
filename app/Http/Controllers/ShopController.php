<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function index()
    {
        return view('shop');
    }
    public function showPaymentPage(Request $request)
    {
        // Logic to show the payment page, or handle cart data, etc.
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        $paymentMethod = $request->input('payment_method');
        // Your payment processing logic goes here
        return "Je hebt gekozen voor: " . ucfirst($paymentMethod) . ". Bedankt voor je bestelling! 🎉";
    }


}
