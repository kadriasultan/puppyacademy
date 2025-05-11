<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dagopvang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function manageDagopvang()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/');
        }

        $dagopvangs = Dagopvang::with('user')
            ->orderBy('voorkeursdatum', 'asc')
            ->get()
            ->groupBy('voorkeursdatum');


        // Get all dagopvang records and group them by voorkeursdatum
        $dagopvangs = Dagopvang::select('voorkeursdatum', 'naam', 'adres', 'woonplaats', 'soort_hond', 'naam_hond', 'roepnaam', 'telefoon', 'email', 'user_id', 'dog_id')
            ->orderBy('voorkeursdatum', 'asc')
            ->get()
            ->groupBy('voorkeursdatum');  // Group by voorkeursdatum

        return view('admin.manage-dagopvang', compact('dagopvangs'));
    }

    public function index()
    {
        return view('admin.dashboard'); // Dashboard view voor admin
    }

    public function showUsers()
    {
        $users = User::all(); // Haal alle gebruikers op
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create'); // View voor het aanmaken van een nieuwe gebruiker
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|max:50',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id); // Zoek de gebruiker op basis van ID
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required|string|max:50',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Update het wachtwoord alleen als het is ingevuld
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

}
