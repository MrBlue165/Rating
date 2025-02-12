<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSessionData(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
            'last_login_at' => $request->user()->last_login_at,
        ]);
    }

}
