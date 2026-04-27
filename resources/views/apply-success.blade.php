@extends('layouts.app')

@section('title', 'Application Submitted')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            {{-- Success Header --}}
            <div class="text-center mb-4">
                <div class="mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #16A34A, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                    <i class="fas fa-check text-white fs-2"></i>
                </div>
                <h2 class="fw-bold mb-2">Application Submitted Successfully!</h2>
                <p class="text-muted">Thank you for applying. Please save your credentials and download your challan.</p>
            </div>

            {{-- Application ID --}}
            <div class="card-custom p-4 mb-4 text-center" style="background: linear-gradient(135deg, var(--primary-navy), var(--primary-blue)); border: none;">
                <p class="text-white mb-1" style="opacity: 0.85;">Application ID</p>
                <h3 class="text-white mb-0 fw-bold" style="font-size: 2rem;">{{ $application_id }}</h3>
            </div>

            {{-- Login Credentials --}}
            @if($password)
            {{-- New user — show password --}}
            <div class="card-custom p-4 mb-4">
                <div class="d-flex align-items-center gap-3 mb-3" style="border-bottom: 1px solid var(--gray-light); padding-bottom: 1rem;">
                    <div style="width: 44px; height: 44px; background: rgba(245,158,11,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-key" style="color: var(--orange-gold);"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">Your Login Credentials</h5>
                        <p class="text-muted mb-0 small">Save this password — dashboard access ke liye chahiye</p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="p-3 text-center" style="background: rgba(59,130,246,0.07); border-radius: 10px;">
                            <small class="text-muted d-block mb-1">Email</small>
                            <strong>{{ $application?->email }}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 text-center" style="background: rgba(245,158,11,0.1); border-radius: 10px;">
                            <small class="text-muted d-block mb-1">Temporary Password</small>
                            <code class="fs-5 fw-bold" style="color: var(--orange-gold);">{{ $password }}</code>
                        </div>
                    </div>
                </div>
            </div>
            @else
            {{-- Existing user — already has password --}}
            <div class="card-custom p-4 mb-4" style="border-left: 4px solid #16A34A;">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 44px; height: 44px; background: rgba(22,163,74,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink:0;">
                        <i class="fas fa-user-check" style="color: #16A34A;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1" style="color: #16A34A;">Existing Account Linked</h5>
                        <p class="text-muted mb-0 small">
                            Yeh application aapke existing account se link ho gayi.<br>
                            <strong>{{ $application?->email }}</strong> email se login karein — password same hai jo pehle mila tha.
                        </p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Fee Challan Preview --}}
            @if($challan && $application && $position)
            <div class="card-custom mb-4" style="border: 2px solid #1B3A6B; overflow: hidden;">
                {{-- Challan Header --}}
                <div style="background: #1B3A6B; color: white; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h5 class="fw-bold mb-0" style="letter-spacing: 0.5px;">NATIONAL EDU PORTAL HUB</h5>
                        <small style="opacity: 0.8;">Job Application Fee Challan</small>
                    </div>
                    <div class="text-end">
                        <small style="opacity: 0.75;">Challan No.</small>
                        <div class="fw-bold">{{ $application->application_id }}</div>
                    </div>
                </div>

                <div class="p-4">
                    <div class="row g-3">
                        {{-- Left: Candidate Info --}}
                        <div class="col-md-6">
                            <div class="p-3 rounded" style="background: rgba(27,58,107,0.05); border: 1px solid #dee2e6;">
                                <div class="fw-bold mb-2" style="color: #1B3A6B; border-bottom: 1px solid #dee2e6; padding-bottom: 6px;">
                                    <i class="fas fa-user me-2"></i>Candidate Information
                                </div>
                                <table class="w-100" style="font-size: 0.875rem;">
                                    <tr>
                                        <td class="text-muted py-1" style="width:40%;">Name</td>
                                        <td class="fw-bold py-1">{{ $application->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">CNIC</td>
                                        <td class="fw-bold py-1">{{ $application->cnic }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">Father Name</td>
                                        <td class="fw-bold py-1">{{ $application->father_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">Mobile</td>
                                        <td class="fw-bold py-1">{{ $application->mobile }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">Post Applied</td>
                                        <td class="fw-bold py-1" style="color: #1B3A6B;">{{ $position->title }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        {{-- Right: Fee & Bank Info --}}
                        <div class="col-md-6">
                            {{-- Fee Details --}}
                            <div class="p-3 rounded mb-3" style="background: rgba(245,158,11,0.08); border: 1px solid rgba(245,158,11,0.3);">
                                <div class="fw-bold mb-2" style="color: #D97706; border-bottom: 1px solid rgba(245,158,11,0.3); padding-bottom: 6px;">
                                    <i class="fas fa-receipt me-2"></i>Fee Details
                                </div>
                                <div class="d-flex justify-content-between py-1" style="font-size: 0.875rem;">
                                    <span class="text-muted">Application Fee</span>
                                    <span class="fw-bold">Rs. {{ number_format($challan->fee_amount) }}/-</span>
                                </div>
                                @if($challan->bank_charges > 0)
                                <div class="d-flex justify-content-between py-1" style="font-size: 0.875rem;">
                                    <span class="text-muted">Bank Charges</span>
                                    <span class="fw-bold">Rs. {{ number_format($challan->bank_charges) }}/-</span>
                                </div>
                                @endif
                                <div class="d-flex justify-content-between py-2 mt-1" style="border-top: 2px solid rgba(245,158,11,0.4); font-size: 1rem;">
                                    <span class="fw-bold">Total Amount</span>
                                    <span class="fw-bold" style="color: #D97706; font-size: 1.1rem;">Rs. {{ number_format($challan->total_amount) }}/-</span>
                                </div>
                            </div>

                            {{-- Bank Details --}}
                            <div class="p-3 rounded" style="background: rgba(37,99,235,0.05); border: 1px solid rgba(37,99,235,0.2);">
                                <div class="fw-bold mb-2" style="color: #1B3A6B; border-bottom: 1px solid rgba(37,99,235,0.2); padding-bottom: 6px;">
                                    <i class="fas fa-university me-2"></i>Bank Details
                                </div>
                                <table class="w-100" style="font-size: 0.8rem;">
                                    <tr>
                                        <td class="text-muted py-1" style="width:42%;">Bank</td>
                                        <td class="fw-bold py-1">National Bank of Pakistan</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">A/c Title</td>
                                        <td class="fw-bold py-1">National EduPortal Hub</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">A/c Number</td>
                                        <td class="fw-bold py-1">3513609247</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">IBAN</td>
                                        <td class="fw-bold py-1" style="font-size: 0.75rem;">PK03NBPA0224003513609247</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted py-1">Also Via</td>
                                        <td class="fw-bold py-1">JazzCash | Easypaisa</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Instructions --}}
                    <div class="mt-3 p-3 rounded" style="background: #fff9e6; border: 1px solid #F59E0B; font-size: 0.8rem;">
                        <strong style="color: #D97706;"><i class="fas fa-exclamation-triangle me-1"></i>Important Instructions:</strong>
                        <ol class="mb-0 mt-1 ps-3">
                            <li>Fee is non-refundable.</li>
                            <li>Incomplete applications will not be accepted.</li>
                            <li>After fee payment, login and upload the paid receipt.</li>
                            <li>Bring original receipt at interview.</li>
                        </ol>
                    </div>
                </div>
            </div>
            @endif

            {{-- Action Buttons --}}
            <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
                <a href="{{ route('challan.download', $application_id) }}" class="btn btn-orange btn-lg">
                    <i class="fas fa-download me-2"></i> Download Challan (PDF)
                </a>
                <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i> Login to Upload Documents
                </a>
            </div>

            {{-- Next Steps --}}
            <div class="card-custom p-4">
                <h5 class="fw-bold mb-3"><i class="fas fa-list-check me-2" style="color: var(--royal-blue);"></i>Next Steps</h5>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex align-items-center gap-3 p-3" style="background: rgba(59,130,246,0.05); border-radius: 10px;">
                        <div style="width: 32px; height: 32px; background: var(--royal-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; flex-shrink: 0;">1</div>
                        <div><span class="fw-bold">Download Fee Challan</span> <small class="text-muted d-block">Click the button above to get your PDF challan</small></div>
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3" style="background: rgba(59,130,246,0.05); border-radius: 10px;">
                        <div style="width: 32px; height: 32px; background: var(--royal-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; flex-shrink: 0;">2</div>
                        <div><span class="fw-bold">Pay the Fee</span> <small class="text-muted d-block">National Bank, JazzCash or Easypaisa — Rs. {{ $challan ? number_format($challan->total_amount) : '300' }}</small></div>
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3" style="background: rgba(59,130,246,0.05); border-radius: 10px;">
                        <div style="width: 32px; height: 32px; background: var(--royal-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; flex-shrink: 0;">3</div>
                        <div><span class="fw-bold">Upload Paid Challan + CV</span> <small class="text-muted d-block">Login with email & password above, then upload documents</small></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
