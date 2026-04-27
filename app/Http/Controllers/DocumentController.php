<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function uploadCv(Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:5120',
        ]);

        $user = Auth::user();
        $application = $user->application;
        $documents = $application->documents;

        if ($documents->cv_path && Storage::exists($documents->cv_path)) {
            Storage::delete($documents->cv_path);
        }

        $file = $request->file('cv');
        $path = $file->store('uploads/cvs');

        $documents->update([
            'cv_path' => $path,
            'cv_original_name' => $file->getClientOriginalName(),
            'cv_size' => $file->getSize(),
            'cv_uploaded_at' => now(),
        ]);

        return back()->with('success', 'CV uploaded successfully!');
    }

    public function uploadChallan(Request $request)
    {
        $request->validate([
            'challan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $user = Auth::user();
        $application = $user->application;
        $documents = $application->documents;

        if ($documents->challan_path && Storage::exists($documents->challan_path)) {
            Storage::delete($documents->challan_path);
        }

        $file = $request->file('challan');
        $path = $file->store('uploads/challans');

        $documents->update([
            'challan_path' => $path,
            'challan_original_name' => $file->getClientOriginalName(),
            'challan_size' => $file->getSize(),
            'challan_uploaded_at' => now(),
        ]);

        return back()->with('success', 'Paid challan uploaded successfully!');
    }

    public function uploadDocuments(Request $request)
    {
        $user        = Auth::user();
        $application = $user->application;
        $documents   = $application->documents;

        $rules = [];
        if ($request->hasFile('cv')) {
            $rules['cv'] = 'file|mimes:pdf|max:5120';
        }
        if ($request->hasFile('challan')) {
            $rules['challan'] = 'file|mimes:pdf,jpg,jpeg,png|max:5120';
        }
        if (!$request->hasFile('cv') && !$documents->cv_path) {
            $rules['cv'] = 'required|file|mimes:pdf|max:5120';
        }
        if (!$request->hasFile('challan') && !$documents->challan_path) {
            $rules['challan'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()], 422);
            }
            return back()->withErrors($validator);
        }

        $updates = [];

        if ($request->hasFile('cv')) {
            if ($documents->cv_path && Storage::exists($documents->cv_path)) {
                Storage::delete($documents->cv_path);
            }
            $file = $request->file('cv');
            $updates['cv_path']          = $file->store('uploads/cvs');
            $updates['cv_original_name'] = $file->getClientOriginalName();
            $updates['cv_size']          = $file->getSize();
            $updates['cv_uploaded_at']   = now();
        }

        if ($request->hasFile('challan')) {
            if ($documents->challan_path && Storage::exists($documents->challan_path)) {
                Storage::delete($documents->challan_path);
            }
            $file = $request->file('challan');
            $updates['challan_path']          = $file->store('uploads/challans');
            $updates['challan_original_name'] = $file->getClientOriginalName();
            $updates['challan_size']          = $file->getSize();
            $updates['challan_uploaded_at']   = now();
        }

        if (!empty($updates)) {
            $documents->update($updates);
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'redirect' => route('home')]);
        }

        return redirect()->route('home')->with('success', 'Documents successfully uploaded! Admin will verify and update your status.');
    }

    public function download($path)
    {
        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        $fileName = basename($path);
        return Storage::download($path, $fileName);
    }

    public function viewInline($path)
    {
        if (!Storage::exists($path)) {
            abort(404, 'File not found');
        }

        return Storage::response($path);
    }
}