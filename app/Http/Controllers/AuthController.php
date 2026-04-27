<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check() && auth()->user()->role === 'candidate') {
            return redirect()->route('upload.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid email or password']);
        }

        if ($user->role === 'admin') {
            return back()->withErrors(['email' => 'Admin must login from admin panel']);
        }

        Auth::login($user);
        return redirect()->route('upload.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function dashboard()
    {
        $user = Auth::user();

        // Latest application (for upload form)
        $application = $user->application ?? null;
        $documents   = $application?->documents ?? null;
        $challan     = $application?->challan ?? null;

        // All applications by this email (for history list)
        $allApplications = \App\Models\Application::where('email', $user->email)
            ->with('position', 'challan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('upload', compact('application', 'documents', 'challan', 'allApplications'));
    }
}