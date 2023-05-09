<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book;
use App\Models\Transaction;
use App\Http\Controllers\Controller;



class UserController extends Controller
{
    public function index()
{
    $users = User::all();
    return response()->json($users);
}

public function store(Request $request)
{
    $user = User::create($request->all());
    return response()->json($user, 201);
}

public function show(User $user)
{
    return response()->json($user);
}

// public function update(Request $request, User $user)
// {
//     $user->update($request->all());
//     return response()->json($user);
// }
public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'password' => 'nullable|string|min:8',
        'phone' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
    ]);

    $user->update($validatedData);

    return response()->json($user);
}

public function destroy(User $user)
{
    $user->delete();
    return response()->json([
        'message' => 'User deleted successfully.'
    ]);
}

}
