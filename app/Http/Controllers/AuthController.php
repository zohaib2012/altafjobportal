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

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'cnic'  => 'required|string',
        ]);

        // Find application matching email + cnic
        $application = Application::where('email', $request->email)
            ->where('cnic', $request->cnic)
            ->first();

        if (!$application) {
            return back()->withInput()->withErrors(['email' => 'Koi record nahi mila. Email ya CNIC galat hai.']);
        }

        // Find or get the user account
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->withErrors(['email' => 'Is email ka koi account nahi hai. Pehle apply karein.']);
        }

        // Generate new random password
        $newPassword = 'NEPH-' . strtoupper(substr(md5(time()), 0, 6));
        $user->update(['password' => Hash::make($newPassword)]);

        return redirect()->route('forgot.password')->with('new_password', $newPassword);
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