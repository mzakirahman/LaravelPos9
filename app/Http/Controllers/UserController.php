<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(3);
        $user = Auth::user();
        return view('users.index', compact('users', 'user'));
    }

    public function create()
    {
        return view('users.create')->with([
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'level' => 'required|numeric|max:255'
        ]);
        $users = $request->except(['_token', 'submit']);
        $users['password'] = bcrypt($request->password);
        User::create($users);
        return redirect('/users');;
    }


    public function edit($id)
    {
        $users =  User::find($id);
        $user = Auth::user();
        return view('users.edit', compact('users', 'user'));
    }

    public function update($id, Request $request)
    {
        $users =  User::find($id);
        $user = Auth::user();
        $users->update($request->except(['_token','submit']));
        return redirect('/users');
    }

    public function destroy($id)
    {
        $users = User::find($id); 
        $user = Auth::user(); 
        $users->delete();
        return redirect('/users');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

             // Lakukan pencarian data sesuai dengan kata kunci (keyword)

            // Contoh:
        $users =  User::where('name', 'like', '%' . $keyword . '%')
                           ->orWhere('email', 'like', '%' . $keyword . '%')
                           ->orWhere('username', 'like', '%' . $keyword . '%')
                           ->orWhere('password', 'like', '%' . $keyword . '%')
                           ->orWhere('level', 'like', '%' . $keyword . '%')
                           ->get();

            // Kirim data hasil pencarian ke tampilan (view) yang sesuai

             // Contoh:
             $user = Auth::user();
             return view('users.index', compact('users', 'user'));
    }
}
