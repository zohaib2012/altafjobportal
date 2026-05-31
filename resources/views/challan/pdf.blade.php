<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Job Application Fee Challan</title>
    <style>
        @page { size: A4 landscape; margin: 6mm; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 7.5pt; background: #fff; }

        .main-table { width: 100%; border-collapse: collapse; }
        .copy-cell { width: 33.33%; vertical-align: top; border: 1.5pt solid #1B3A6B; padding: 5pt; }
        .copy-cell + .copy-cell { border-left: 1pt dashed #aaa; }

        .logo-row { text-align: center; border-bottom: 1.5pt solid #1B3A6B; padding-bottom: 4pt; margin-bottom: 4pt; }
        .org-name { font-size: 10pt; font-weight: bold; color: #1B3A6B; letter-spacing: 0.3pt; }
        .org-tagline { font-size: 7pt; color: #2563EB; }

        .title-bar { background: #1B3A6B; color: #fff; text-align: center; font-weight: bold; font-size: 8pt; padding: 3pt; margin-bottom: 4pt; }

        .challan-no { text-align: right; font-size: 7pt; font-weight: bold; margin-bottom: 4pt; color: #1B3A6B; }

        .info-row { display: table; width: 100%; border-bottom: 0.5pt solid #ddd; margin-bottom: 1pt; }
        .info-label { display: table-cell; width: 38%; font-size: 7pt; color: #555; padding: 2pt 0; }
        .info-value { display: table-cell; font-size: 7pt; font-weight: bold; padding: 2pt 0; }

        .section-header { background: #1B3A6B; color: #fff; font-weight: bold; font-size: 7pt; padding: 2pt 4pt; margin: 5pt 0 3pt; }

        .fee-table { width: 100%; }
        .fee-row { display: table; width: 100%; border-bottom: 0.5pt solid #eee; padding: 2pt 0; }
        .fee-label { display: table-cell; font-size: 7pt; color: #444; }
        .fee-value { display: table-cell; font-size: 7pt; font-weight: bold; text-align: right; }
        .fee-total { background: rgba(27,58,107,0.07); }
        .fee-total .fee-label,
        .fee-total .fee-value { font-size: 8pt; font-weight: bold; color: #1B3A6B; }

        .field-line { border-bottom: 0.5pt solid #333; height: 12pt; margin-bottom: 3pt; }
        .field-label { font-size: 6.5pt; color: #555; }

        .instruction-list { padding-left: 9pt; margin-top: 2pt; }
        .instruction-list li { font-size: 6.5pt; color: #333; margin-bottom: 1.5pt; }

        .copy-label { text-align: center; font-size: 6.5pt; font-weight: bold; margin-top: 3pt; padding: 1.5pt; }
        .label-bank { background: #1B3A6B; color: #fff; }
        .label-candidate { background: #16A34A; color: #fff; }
        .label-office { background: #F59E0B; color: #1B3A6B; }
    </style>
</head>
<body>

<table class="main-table">
<tr>

{{-- ===== COPY 1: BANK COPY ===== --}}
<td class="copy-cell">
    <div class="logo-row">
        <div class="org-name">NATIONAL EDU PORTAL HUB</div>
        <div class="org-tagline">LEARN &bull; CONNECT &bull; SUCCEED</div>
    </div>

    <div class="title-bar">Job Application Fee Challan</div>
    <div class="challan-no">Challan No: {{ $application->application_id }}</div>

    <div class="info-row">
        <div class="info-label">Project Name:</div>
        <div class="info-value">National Edu Portal Hub</div>
    </div>
    <div class="info-row">
        <div class="info-label">Post Applied For:</div>
        <div class="info-value">{{ $position->title }}</div>
    </div>

    <div class="section-header">Candidate Information</div>
    <div class="info-row"><div class="info-label">Name:</div><div class="info-value">{{ $application->full_name }}</div></div>
    <div class="info-row"><div class="info-label">CNIC:</div><div class="info-value">{{ $application->cnic }}</div></div>
    <div class="info-row"><div class="info-label">Father Name:</div><div class="info-value">{{ $application->father_name }}</div></div>
    <div class="info-row"><div class="info-label">Mobile Number:</div><div class="info-value">{{ $application->mobile }}</div></div>

    <div class="section-header">Fee Details</div>
    <div class="fee-table">
        <div class="fee-row"><div class="fee-label">Application Fee:</div><div class="fee-value">Rs. {{ number_format($challan->fee_amount) }}/-</div></div>
        <div class="fee-row"><div class="fee-label">Bank Charges:</div><div class="fee-value">Rs. {{ number_format($challan->bank_charges) }}/-</div></div>
        <div class="fee-row fee-total"><div class="fee-label">Total Amount:</div><div class="fee-value">Rs. {{ number_format($challan->total_amount) }}/-</div></div>
    </div>

    <div class="section-header">Bank Details</div>
    <div class="info-row"><div class="info-label">Bank Name:</div><div class="info-value">Faysal Bank</div></div>
    <div class="info-row"><div class="info-label">Account Title:</div><div class="info-value">National EduPortal Hub</div></div>
    <div class="info-row"><div class="info-label">Account No:</div><div class="info-value">3546499000004682</div></div>
    <div class="info-row"><div class="info-label">IBAN:</div><div class="info-value">PK69FAYS3546499000004682</div></div>

    <div class="section-header">Payment Details</div>
    <div class="field-label">Deposit Date:</div>
    <div class="field-line"></div>
    <div class="field-label">Transaction ID / Slip No:</div>
    <div class="field-line"></div>

    <div class="section-header">Important Instructions</div>
    <ol class="instruction-list">
        <li>Bring original receipt at interview.</li>
        <li>Incomplete applications will not be accepted.</li>
        <li>After fee submission, upload paid receipt online.</li>
        <li>Fee is non-refundable.</li>
    </ol>

    <div class="copy-label label-bank">BANK COPY</div>
</td>

{{-- ===== COPY 2: CANDIDATE COPY ===== --}}
<td class="copy-cell">
    <div class="logo-row">
        <div class="org-name">NATIONAL EDU PORTAL HUB</div>
        <div class="org-tagline">LEARN &bull; CONNECT &bull; SUCCEED</div>
    </div>

    <div class="title-bar">Job Application Fee Challan</div>
    <div class="challan-no">Challan No: {{ $application->application_id }}</div>

    <div class="info-row">
        <div class="info-label">Project Name:</div>
        <div class="info-value">National Edu Portal Hub</div>
    </div>
    <div class="info-row">
        <div class="info-label">Post Applied For:</div>
        <div class="info-value">{{ $position->title }}</div>
    </div>

    <div class="section-header">Candidate Information</div>
    <div class="info-row"><div class="info-label">Name:</div><div class="info-value">{{ $application->full_name }}</div></div>
    <div class="info-row"><div class="info-label">CNIC:</div><div class="info-value">{{ $application->cnic }}</div></div>
    <div class="info-row"><div class="info-label">Father Name:</div><div class="info-value">{{ $application->father_name }}</div></div>
    <div class="info-row"><div class="info-label">Mobile Number:</div><div class="info-value">{{ $application->mobile }}</div></div>

    <div class="section-header">Fee Details</div>
    <div class="fee-table">
        <div class="fee-row"><div class="fee-label">Application Fee:</div><div class="fee-value">Rs. {{ number_format($challan->fee_amount) }}/-</div></div>
        <div class="fee-row"><div class="fee-label">Bank Charges:</div><div class="fee-value">Rs. {{ number_format($challan->bank_charges) }}/-</div></div>
        <div class="fee-row fee-total"><div class="fee-label">Total Amount:</div><div class="fee-value">Rs. {{ number_format($challan->total_amount) }}/-</div></div>
    </div>

    <div class="section-header">Bank Details</div>
    <div class="info-row"><div class="info-label">Bank Name:</div><div class="info-value">Faysal Bank</div></div>
    <div class="info-row"><div class="info-label">Account Title:</div><div class="info-value">National EduPortal Hub</div></div>
    <div class="info-row"><div class="info-label">Account No:</div><div class="info-value">3546499000004682</div></div>
    <div class="info-row"><div class="info-label">IBAN:</div><div class="info-value">PK69FAYS3546499000004682</div></div>

    <div class="section-header">Payment Details</div>
    <div class="field-label">Deposit Date:</div>
    <div class="field-line"></div>
    <div class="field-label">Transaction ID / Slip No:</div>
    <div class="field-line"></div>

    <div class="section-header">Important Instructions</div>
    <ol class="instruction-list">
        <li>Bring original receipt at interview.</li>
        <li>Incomplete applications will not be accepted.</li>
        <li>After fee submission, upload paid receipt online.</li>
        <li>Fee is non-refundable.</li>
    </ol>

    <div class="copy-label label-candidate">CANDIDATE COPY</div>
</td>

{{-- ===== COPY 3: OFFICE COPY ===== --}}
<td class="copy-cell">
    <div class="logo-row">
        <div class="org-name">NATIONAL EDU PORTAL HUB</div>
        <div class="org-tagline">LEARN &bull; CONNECT &bull; SUCCEED</div>
    </div>

    <div class="title-bar">Job Application Fee Challan</div>
    <div class="challan-no">Challan No: {{ $application->application_id }}</div>

    <div class="info-row">
        <div class="info-label">Project Name:</div>
        <div class="info-value">National Edu Portal Hub</div>
    </div>
    <div class="info-row">
        <div class="info-label">Post Applied For:</div>
        <div class="info-value">{{ $position->title }}</div>
    </div>

    <div class="section-header">Candidate Information</div>
    <div class="info-row"><div class="info-label">Name:</div><div class="info-value">{{ $application->full_name }}</div></div>
    <div class="info-row"><div class="info-label">CNIC:</div><div class="info-value">{{ $application->cnic }}</div></div>
    <div class="info-row"><div class="info-label">Father Name:</div><div class="info-value">{{ $application->father_name }}</div></div>
    <div class="info-row"><div class="info-label">Mobile Number:</div><div class="info-value">{{ $application->mobile }}</div></div>

    <div class="section-header">Fee Details</div>
    <div class="fee-table">
        <div class="fee-row"><div class="fee-label">Application Fee:</div><div class="fee-value">Rs. {{ number_format($challan->fee_amount) }}/-</div></div>
        <div class="fee-row"><div class="fee-label">Bank Charges:</div><div class="fee-value">Rs. {{ number_format($challan->bank_charges) }}/-</div></div>
        <div class="fee-row fee-total"><div class="fee-label">Total Amount:</div><div class="fee-value">Rs. {{ number_format($challan->total_amount) }}/-</div></div>
    </div>

    <div class="section-header">Bank Details</div>
    <div class="info-row"><div class="info-label">Bank Name:</div><div class="info-value">Faysal Bank</div></div>
    <div class="info-row"><div class="info-label">Account Title:</div><div class="info-value">National EduPortal Hub</div></div>
    <div class="info-row"><div class="info-label">Account No:</div><div class="info-value">3546499000004682</div></div>
    <div class="info-row"><div class="info-label">IBAN:</div><div class="info-value">PK69FAYS3546499000004682</div></div>

    <div class="section-header">Payment Details</div>
    <div class="field-label">Deposit Date:</div>
    <div class="field-line"></div>
    <div class="field-label">Transaction ID / Slip No:</div>
    <div class="field-line"></div>

    <div class="section-header">Important Instructions</div>
    <ol class="instruction-list">
        <li>Bring original receipt at interview.</li>
        <li>Incomplete applications will not be accepted.</li>
        <li>After fee submission, upload paid receipt online.</li>
        <li>Fee is non-refundable.</li>
    </ol>

    <div class="copy-label label-office">OFFICE COPY</div>
</td>

</tr>
</table>

</body>
</html>
