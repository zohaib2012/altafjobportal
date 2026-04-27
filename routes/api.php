<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

return function (Request $request) {
    // API routes without CSRF
    Route::post('/admin/login', [DashboardController::class, 'loginApi']);
    
    // Fallback web route - try direct login without middleware
    Route::post('/admin/direct-login', function(Request $req) {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = \App\Models\User::where('email', $req->email)->first();
        
        if (!$user || !\Illuminate\Support\Facades\Hash::check($req->password, $user->password) || $user->role !== 'admin') {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        
        \Illuminate\Support\Facades\Auth::login($user);
        
        return response()->json(['success' => true, 'redirect' => route('admin.dashboard')]);
    });
};