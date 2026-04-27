<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $positions = Position::where('is_active', true)->get();
        return view('home', compact('positions'));
    }

    public function instructions()
    {
        return view('instructions');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|max:200',
            'subject' => 'nullable|string|max:300',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}