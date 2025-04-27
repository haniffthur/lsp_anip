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
public function edit(string $id)
{
    $data = User::findOrFail($id);

    return view('pages.user.edit', [
        'data' => $data
    ]);
}

public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    // Validasi
    $validated = $request->validate([
        'username' => 'required|string|max:255',
        'password' => 'nullable|string|min:6',
        'role' => 'required|in:ADMIN,KASIR,WAITER,OWNER',
    ]);

    // Siapkan data update
    $updateData = [
        'username' => $validated['username'],
        'role' => $validated['role'],
    ];

    // Kalau password diisi, hash dulu
    if (!empty($validated['password'])) {
        $updateData['password'] = bcrypt($validated['password']);
    }

    // Update user
    $user->update($updateData);

    return redirect()->route('user.index')->with('update-data-success', 'Data berhasil diperbarui');
}

}
