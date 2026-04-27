<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Challan;
use Barryvdh\DomPDF\Facade\Pdf;

class ChallanController extends Controller
{
    public function download($applicationId)
    {
        $application = Application::where('application_id', $applicationId)->firstOrFail();
        $challan = $application->challan;
        $position = $application->position;

        $pdf = Pdf::loadView('challan.pdf', [
            'application' => $application,
            'challan' => $challan,
            'position' => $position,
        ]);

        return $pdf->download('Challan-' . $applicationId . '.pdf');
    }

    public function view($applicationId)
    {
        $application = Application::where('application_id', $applicationId)->firstOrFail();
        $challan = $application->challan;
        $position = $application->position;

        return view('challan.pdf', [
            'application' => $application,
            'challan' => $challan,
            'position' => $position,
        ]);
    }
}