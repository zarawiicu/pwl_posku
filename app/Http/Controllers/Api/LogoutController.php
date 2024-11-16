<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            // Mendapatkan token dari request
            $token = JWTAuth::getToken();

            // Menghapus atau meng-invalidasi token
            if ($token) {
                JWTAuth::invalidate($token);

                return response()->json([
                    'success' => true,
                    'message' => 'Logout berhasil!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Token tidak ditemukan.',
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout gagal, token tidak valid atau sudah kedaluwarsa.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

