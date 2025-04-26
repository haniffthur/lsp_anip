<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view ('pages.user.index',compact('data'));
    }
    public function create()
{
    return view('pages.user.add');
}
public function store(Request $request)
{
    $validatedData = $request->validate([
        'username' => 'required|string|max:255|unique:users,username',
        'password' => 'required|string|min:6',
        'role' => 'required|string|in:ADMIN,KASIR,OWNER,WAITER',
    ]);
    // Enkripsi password sebelum disimpan
    $validatedData['password'] = bcrypt($validatedData['password']);

    User::create($validatedData);

    return redirect()->route('user.index')->with('success', 'Data User berhasil ditambahkan.');
}
public function destroy (string $id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('user.index')->with('delete-data-success', 'Data berhasil dihapus');
}
}
