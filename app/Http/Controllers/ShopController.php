<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index()
    {
        $courses = Shop::where('type', 'course')->get();
        $diys = Shop::where('type', 'diy')->get();
        return view('shop', compact('courses', 'diys'));
    }

    public function showPaymentPage(Request $request)
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        $paymentMethod = $request->input('payment_method');

        // Hier zou je normaal de betaling verwerken via je betaalprovider
        // Voor nu simuleren we een succesvolle betaling

        $betalingGeslaagd = true; // Simulatie

        if ($betalingGeslaagd) {
            // Na succesvolle betaling redirect naar bedankpagina
            return redirect()->route('shop')->with('success', 'Bedankt! We gaan de betaling controleren en nemen contact met je op zodra deze is bevestigd.');
        } else {
            // Bij mislukte betaling terug naar betaalpagina met foutmelding
            return redirect()->back()->withErrors('Betaling is mislukt, probeer het opnieuw.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'type' => 'required|in:course,diy',
        ]);

        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $imageName);

        Shop::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Product toegevoegd!');
    }

    public function update(Request $request, $id)
    {
        $item = Shop::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;

        if ($request->hasFile('image')) {
            // Verwijder oude afbeelding (optioneel)
            if ($item->image && file_exists(public_path('images/' . $item->image))) {
                unlink(public_path('images/' . $item->image));
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
            $item->image = $imageName;
        }

        $item->save();

        return redirect()->back()->with('success', 'Product bijgewerkt!');
    }

    public function destroy($id)
    {
        $item = Shop::findOrFail($id);

        // Verwijder afbeelding (optioneel)
        if ($item->image && file_exists(public_path('images/' . $item->image))) {
            unlink(public_path('images/' . $item->image));
        }

        $item->delete();

        return redirect()->back()->with('success', 'Product verwijderd!');
    }
}
