<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\TokenApiHelper;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try
        {
            return TokenApiHelper::login($request);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
