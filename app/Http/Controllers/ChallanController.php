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

        $qrCodeBase64 = null;
        $qrPath = public_path('images/qrcode.png');
        if (file_exists($qrPath)) {
            $qrCodeBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($qrPath));
        }

        $pdf = Pdf::loadView('challan.pdf', [
            'application'    => $application,
            'challan'        => $challan,
            'position'       => $position,
            'qrCodeBase64'   => $qrCodeBase64,
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