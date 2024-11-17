<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index() {
        return UserModel::all();
    }

    public function store(Request $request) {
        $request->validate([
            'username' => 'required|string|unique:m_user',
            'nama' => 'required|string',
            'password' => 'required|string',
            'level_id' => 'required|exists:m_level,level_id'
        ]);

        $user = UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id
        ]);

        return response()->json($user, 201);
    }

    public function show(UserModel $user) {
        return $user;
    }

    public function update(Request $request, UserModel $user) {
        $request->validate([
            'username' => 'string|unique:m_user,username,' . $user->id,
            'nama' => 'string',
            'password' => 'string',
            'level_id' => 'exists:m_level,level_id'
        ]);

        $user->update($request->all());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return $user;
    }

    public function destroy(UserModel $user) {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User Berhasil Dihapus'
        ]);
    }
}
