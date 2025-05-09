<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DogController extends Controller
{
    /**
     * Display a listing of the user's dogs.
     */
    public function index()
    {
        $dogs = Auth::user()->dogs;
        return view('dogs.index', compact('dogs'));
    }

    /**
     * Show the form for creating a new dog.
     */
    public function create()
    {
        return view('dogs.create');
    }

    /**
     * Store a newly created dog in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
        ]);

        Auth::user()->dogs()->create($request->all());

        return redirect()->route('profile.show')
            ->with('success', 'Dog added successfully!');
    }

    /**
     * Display the specified dog.
     */
    public function show(Dog $dog)
    {
        $this->authorize('view', $dog);
        return view('dogs.show', compact('dog'));
    }

    /**
     * Show the form for editing the specified dog.
     */
    public function edit(Dog $dog)
    {
        $this->authorize('update', $dog);
        return view('dogs.edit', compact('dog'));
    }

    /**
     * Update the specified dog in storage.
     */
    public function update(Request $request, Dog $dog)
    {
        $this->authorize('update', $dog);

        $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
        ]);

        $dog->update($request->all());

        return redirect()->route('profile.show')
            ->with('success', 'Dog updated successfully!');
    }

    /**
     * Remove the specified dog from storage.
     */
    public function destroy(Dog $dog)
    {
        $this->authorize('delete', $dog);
        $dog->delete();

        return redirect()->route('profile.show')
            ->with('success', 'Dog removed successfully!');
    }
}
