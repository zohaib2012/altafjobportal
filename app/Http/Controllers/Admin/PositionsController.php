<?php

namespace App\Http\Controllers\Admin;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    public function index()
    {
        $positions = Position::orderBy('id')->get();
        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        return view('admin.positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'                  => 'required|string|max:200',
            'department'             => 'nullable|string|max:200',
            'bps'                    => 'nullable|string|max:50',
            'vacancies'              => 'nullable|integer|min:0',
            'age_limit'              => 'nullable|string|max:50',
            'qualification_required' => 'nullable|string|max:200',
            'domicile'               => 'nullable|string|max:200',
            'fee_amount'             => 'required|integer|min:0',
            'is_active'              => 'boolean',
        ]);

        Position::create([
            'title'                  => $request->title,
            'department'             => $request->department,
            'bps'                    => $request->bps,
            'vacancies'              => $request->vacancies,
            'age_limit'              => $request->age_limit,
            'qualification_required' => $request->qualification_required,
            'domicile'               => $request->domicile,
            'fee_amount'             => $request->fee_amount,
            'is_active'              => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.positions')->with('success', 'Position added successfully!');
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id);
        return view('admin.positions.edit', compact('position'));
    }

    public function update(Request $request, $id)
    {
        $position = Position::findOrFail($id);

        $request->validate([
            'title'                  => 'required|string|max:200',
            'department'             => 'nullable|string|max:200',
            'bps'                    => 'nullable|string|max:50',
            'vacancies'              => 'nullable|integer|min:0',
            'age_limit'              => 'nullable|string|max:50',
            'qualification_required' => 'nullable|string|max:200',
            'domicile'               => 'nullable|string|max:200',
            'fee_amount'             => 'required|integer|min:0',
            'is_active'              => 'boolean',
        ]);

        $position->update([
            'title'                  => $request->title,
            'department'             => $request->department,
            'bps'                    => $request->bps,
            'vacancies'              => $request->vacancies,
            'age_limit'              => $request->age_limit,
            'qualification_required' => $request->qualification_required,
            'domicile'               => $request->domicile,
            'fee_amount'             => $request->fee_amount,
            'is_active'              => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.positions')->with('success', 'Position updated successfully!');
    }

    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $count = $position->applications()->count();

        if ($count > 0) {
            return back()->with('error', "Cannot delete — {$count} application(s) exist for this position.");
        }

        $position->delete();
        return redirect()->route('admin.positions')->with('success', 'Position deleted.');
    }

    public function toggle($id)
    {
        $position = Position::findOrFail($id);
        $position->update(['is_active' => !$position->is_active]);
        return back()->with('success', 'Position status toggled.');
    }
}
