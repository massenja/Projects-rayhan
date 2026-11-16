<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data user berhasil diambil.',
                'data' => $users,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'role' => 'nullable|string',
        ]);
        $validate['password'] = bcrypt($validate['password']);

        $user = User::create($validate);

        return response()->json(
            [
                'success' => true,
                'message' => 'User berhasil dibuat.',
                'data' => $user,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {
            $user = User::findOrFail($id);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data user berhasil diambil.',
                    'data' => $user,
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data user tidak ditemukan.',
                    'error' => $e->getMessage(),
                ],
                404
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $user = User::findOrFail($id);

            $data = $request->all();

            if ($request->has('password')) {
                $data['password'] = bcrypt($request->password);
            }

            $user->update($data);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'User berhasil diperbarui.',
                    'data' => $user,
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data user tidak ditemukan.',
                    'error' => $e->getMessage(),
                ],
                404
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'User berhasil dihapus.',
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Data user tidak ditemukan.',
                    'error' => $e->getMessage(),
                ],
                404
            );
        }
    }
}