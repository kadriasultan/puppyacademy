<?php

namespace App\Http\Controllers;

use App\Mail\NewMessageNotification;
use App\Mail\TrainingRegistered;
use App\Mail\TrainingRegisteredAdmin;
use Illuminate\Http\Request;
use App\Models\trainingen;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class TrainingController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request
        $allowedTitles = trainingen::pluck('title')->toArray();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'training' => ['required', 'string', Rule::in($allowedTitles)],
        ]);

        Mail::to($validated['email'])->send(new TrainingRegistered($validated));
        Mail::to('mgm@dr.com')->send(new TrainingRegisteredAdmin($validated));

        return redirect()->back()->with('status', 'Hartelijk bedankt! Inschrijving succesvol! Check je inbox voor bevestiging.');
    }

    public function index()
    {
        $courses = trainingen::where('type', 'course')->get();
        $videos = trainingen::where('type', 'video')->get();
        return view('training', compact('courses', 'videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image',
            'video' => 'nullable|mimes:mp4,avi,mpeg,quicktime',
            'type' => 'required|in:course,video',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
        }


        $videoName = null;
        if ($request->hasFile('video')) {
            $videoName = time() . '_' . $request->file('video')->getClientOriginalName();
            $request->file('video')->move(public_path('videos'), $videoName);
        }

        // Store training data
        trainingen::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
            'video' => $videoName,
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Training toegevoegd!');
    }

    public function update(Request $request, $id)
    {
        $item = trainingen::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image',
            'video' => 'nullable|mimes:mp4,avi,mpeg,quicktime',
        ]);

        // Update item data
        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;

        // Handle Image Upload (if any)
        if ($request->hasFile('image')) {
            // Delete old image (if it exists)
            if ($item->image && file_exists(public_path('images/' . $item->image))) {
                unlink(public_path('images/' . $item->image));
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageName);
            $item->image = $imageName;
        }


        if ($request->hasFile('video')) {
            // Delete old video (if it exists)
            if ($item->video && file_exists(public_path('videos/' . $item->video))) {
                unlink(public_path('videos/' . $item->video));
            }

            $videoName = time() . '_' . $request->file('video')->getClientOriginalName();
            $request->file('video')->move(public_path('videos'), $videoName);  // Store videos in a separate folder
            $item->video = $videoName;
        }

        // Save the updated item
        $item->save();

        return redirect()->back()->with('success', 'Bijgewerkt!');
    }

    public function destroy($id)
    {
        $item = trainingen::findOrFail($id);

        // Delete image (if it exists)
        if ($item->image && file_exists(public_path('images/' . $item->image))) {
            unlink(public_path('images/' . $item->image));
        }

        // Delete video (if it exists)
        if ($item->video && file_exists(public_path('videos/' . $item->video))) {
            unlink(public_path('videos/' . $item->video));
        }

        // Delete the item from the database
        $item->delete();

        return redirect()->back()->with('success', 'Content verwijderd!');
    }
}
