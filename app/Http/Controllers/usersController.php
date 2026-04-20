<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class usersController extends Controller
{
    public function index(){
        $users = User::all();
       return view('usersView', compact('users'));
    }

    public function show($id){
     $user = User::findOrFail($id);
     return view('singleUserView', compact('user'));
    }

    public function store(Request $request){
       User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password),
       ]);
         return redirect('/users');
    }  
    
    public function destroy($id){
    $user = User::findOrFail($id);
    $user->delete();
    return redirect('/users');
}
}

