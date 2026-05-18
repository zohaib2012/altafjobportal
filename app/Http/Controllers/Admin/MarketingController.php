<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketingMessage;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function index()
    {
        $messages = MarketingMessage::latest()->get();
        return view('admin.marketing.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
            'type'    => 'required|in:announcement,warning,success',
        ]);

        MarketingMessage::create([
            'title'     => $request->title,
            'message'   => $request->message,
            'type'      => $request->type,
            'is_active' => true,
        ]);

        return back()->with('success', 'Message add ho gaya!');
    }

    public function toggle($id)
    {
        $msg = MarketingMessage::findOrFail($id);
        $msg->update(['is_active' => !$msg->is_active]);
        return back()->with('success', $msg->is_active ? 'Message active kar diya.' : 'Message hide kar diya.');
    }

    public function destroy($id)
    {
        MarketingMessage::findOrFail($id)->delete();
        return back()->with('success', 'Message delete ho gaya.');
    }
}
