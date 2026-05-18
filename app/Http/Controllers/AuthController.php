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

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'candidate',
        ]);

        Auth::login($user);

        return redirect()->route('apply');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function processForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found. Is email ka koi account nahi hai.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('login')->with('success', 'Password updated successfully! Naye password se login karein.');
    }

    public function dashboard()
    {
        $user = Auth::user();

        // Latest application (for upload form)
        $application = $user->application ?? null;
        $documents   = $application?->documents ?? null;
        $challan     = $application?->challan ?? null;

        // All applications by this email (for history list + upload)
        $allApplications = \App\Models\Application::where('email', $user->email)
            ->with('position', 'challan', 'documents')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('upload', compact('application', 'documents', 'challan', 'allApplications'));
    }
}