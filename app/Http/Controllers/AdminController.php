<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function toggleRegisterAccess(Request $request)
    {
        $registerAccess = $request->input('register_access') === '1';
        Cache::put('register_access', $registerAccess);

        if ($registerAccess) {
            return redirect()->back()->with('success', 'Access to /register granted.');
        } else {
            return redirect()->back()->with('success', 'Access to /register blocked.');
        }
    }
}
