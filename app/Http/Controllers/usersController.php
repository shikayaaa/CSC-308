<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class usersController extends Controller
{
    public function index() {
        $users = User::all();
        return view('usersView', compact('users'));
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view('singleUserView', compact('user'));
    }

    public function store(Request $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect('/users')->with('success', 'User created successfully!');
    }

    // --- ADD THIS UPDATE METHOD ---
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        // Update the basic info
        $user->name = $request->name;
        $user->email = $request->email;

        // Only update password if the user actually typed something in that box
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Redirect back to the main list with a success message
        return redirect('/users')->with('success', 'User updated successfully!');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/users')->with('success', 'User deleted!');
    }
}