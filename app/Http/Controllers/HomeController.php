<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OwnerSection;
class HomeController extends Controller
{
    public function index()
    {
        $owner = OwnerSection::first();
        return view('welcome', compact('owner'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'paragraph_1' => 'required|string',
            'paragraph_2' => 'nullable|string',
            'paragraph_3' => 'nullable|string',
        ]);

        $owner = \App\Models\OwnerSection::findOrFail($id);
        $owner->update([
            'name' => $request->name,
            'paragraph_1' => $request->paragraph_1,
            'paragraph_2' => $request->paragraph_2,
            'paragraph_3' => $request->paragraph_3,
        ]);

        return response()->json(['message' => 'Gegevens opgeslagen']);
    }
    public function uploadImage(Request $request, $id)
    {
        $owner = OwnerSection::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('images/eigenaar');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $imageName);

            $owner->image = 'images/eigenaar/' . $imageName;
            $owner->save();

            return response()->json([
                'success' => true,
                'image_url' => asset($owner->image)
            ]);
        }


        return response()->json(['success' => false], 400);
    }

}
