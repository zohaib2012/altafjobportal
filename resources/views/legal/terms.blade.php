@extends('layouts.app')

@section('title', 'Terms & Conditions')

@section('styles')
<style>
.legal-hero {
    background: linear-gradient(135deg, var(--primary-navy) 0%, #1E3A8A 100%);
    padding: 70px 0 50px;
    position: relative;
    overflow: hidden;
}
.legal-hero::before {
    content: '';
    position: absolute;
    top: -40%;
    right: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(59,130,246,0.2) 0%, transparent 70%);
}
.legal-icon-wrap {
    width: 72px;
    height: 72px;
    background: rgba(255,255,255,0.12);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.25rem;
    font-size: 1.75rem;
    color: #FCD34D;
}
.legal-body {
    padding: 60px 0 80px;
    background: var(--light-bg);
}
.legal-card {
    background: var(--white);
    border-radius: 20px;
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--gray-light);
    overflow: hidden;
}
.legal-nav {
    background: linear-gradient(135deg, var(--primary-navy), #1E3A8A);
    padding: 1.25rem 1.5rem;
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}
.legal-nav a {
    color: rgba(255,255,255,0.75);
    font-size: 0.82rem;
    font-weight: 600;
    padding: 0.35rem 0.85rem;
    border-radius: 8px;
    background: rgba(255,255,255,0.08);
    transition: all 0.2s;
}
.legal-nav a:hover, .legal-nav a.active {
    color: #FCD34D;
    background: rgba(252,211,77,0.12);
}
.legal-content {
    padding: 2.5rem;
}
.section-block {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--gray-light);
}
.section-block:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}
.section-num {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--royal-blue), var(--primary-blue));
    color: white;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 700;
    flex-shrink: 0;
    margin-right: 0.75rem;
}
.section-heading {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}
.section-heading h5 {
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0;
}
.legal-content p, .legal-content li {
    font-size: 0.95rem;
    line-height: 1.8;
    color: var(--gray);
}
.legal-content ul {
    padding-left: 1.25rem;
    margin-top: 0.5rem;
}
.legal-content ul li {
    margin-bottom: 0.35rem;
}
.info-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(59,130,246,0.08);
    color: var(--royal-blue);
    border: 1px solid rgba(59,130,246,0.2);
    border-radius: 8px;
    padding: 0.35rem 0.85rem;
    font-size: 0.8rem;
    font-weight: 600;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}
.other-pages {
    background: var(--white);
    border: 1px solid var(--gray-light);
    border-radius: 16px;
    padding: 1.5rem;
    margin-top: 2rem;
}
.page-link-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: 12px;
    border: 1px solid var(--gray-light);
    transition: all 0.25s;
    color: var(--dark);
    margin-bottom: 0.75rem;
    text-decoration: none;
}
.page-link-card:last-child { margin-bottom: 0; }
.page-link-card:hover {
    border-color: var(--royal-blue);
    background: rgba(59,130,246,0.04);
    transform: translateX(4px);
    color: var(--royal-blue);
}
.page-link-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
</style>
@endsection

@section('content')
<div class="legal-hero text-center text-white">
    <div class="container position-relative" style="z-index:2;">
        <div class="legal-icon-wrap">
            <i class="fas fa-file-contract"></i>
        </div>
        <h1 class="fw-bold mb-2" style="font-size:2rem;">Terms &amp; Conditions</h1>
        <p style="opacity:0.85;font-size:1rem;">Last updated: {{ date('F Y') }}</p>
        <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
            <span class="info-pill" style="background:rgba(255,255,255,0.1);color:#FCD34D;border-color:rgba(252,211,77,0.3);">
                <i class="fas fa-shield-alt"></i> Legal Document
            </span>
            <span class="info-pill" style="background:rgba(255,255,255,0.1);color:rgba(255,255,255,0.8);border-color:rgba(255,255,255,0.2);">
                <i class="fas fa-building"></i> Private Recruitment Platform
            </span>
        </div>
    </div>
</div>

<div class="legal-body">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="legal-card">
                    <div class="legal-nav">
                        <a href="{{ route('terms') }}" class="active"><i class="fas fa-file-contract me-1"></i>Terms</a>
                        <a href="{{ route('privacy') }}"><i class="fas fa-shield-alt me-1"></i>Privacy Policy</a>
                        <a href="{{ route('refund') }}"><i class="fas fa-undo me-1"></i>Refund Policy</a>
                        <a href="{{ route('disclaimer') }}"><i class="fas fa-exclamation-circle me-1"></i>Disclaimer</a>
                    </div>
                    <div class="legal-content">

                        <div class="section-block">
                            <div class="section-heading">
                                <span class="section-num">1</span>
                                <h5>Introduction</h5>
                            </div>
                            <p>Welcome to <strong>National EduPortal Hub</strong> ("we", "our", "us"). This platform is a privately operated recruitment and career information service providing job advertisements, application facilitation, and career-related information.</p>
                            <p class="mt-2">By accessing or using this website, you agree to comply with these Terms &amp; Conditions.</p>
                        </div>

                        <div class="section-block">
                            <div class="section-heading">
                                <span class="section-num">2</span>
                                <h5>Nature of Service</h5>
                            </div>
                            <p>National EduPortal Hub is an <strong>independent, private recruitment and information platform</strong>. It is not a government department, ministry, authority, commission, or public sector organization.</p>
                            <p class="mt-2">We do not represent or act on behalf of any government body unless explicitly stated through official written agreement.</p>
                        </div>

                        <div class="section-block">
                            <div class="section-heading">
                                <span class="section-num">3</span>
                                <h5>No Job Guarantee</h5>
                            </div>
                            <p>We do not guarantee:</p>
                            <ul>
                                <li>Employment or job placement</li>
                                <li>Interview calls or shortlist selection</li>
                                <li>Appointment letters or hiring outcomes</li>
                                <li>Salary, benefits, or job confirmation</li>
                            </ul>
                            <p class="mt-2">Final recruitment decisions are made solely by the respective employer, organization, or hiring entity.</p>
                        </div>

                        <div class="section-block">
                            <div class="section-heading">
                                <span class="section-num">4</span>
                                <h5>Application &amp; Processing Fees</h5>
                            </div>
                            <p>In certain cases, application or processing fees may be charged for services including (but not limited to):</p>
                            <ul>
                                <li>Application processing</li>
                                <li>Document verification facilitation</li>
                                <li>Shortlisting evaluation support</li>
                                <li>Interview or written test coordination</li>
                            </ul>
                            <p class="mt-2">All such fees are charged for administrative and service-related purposes only and are <strong>non-transferable and strictly non-refundable</strong>, regardless of application outcome.</p>
                        </div>

                        <div class="section-block">
                            <div class="section-heading">
                                <span class="section-num">5</span>
                                <h5>User Responsibility</h5>
                            </div>
                            <p>Users are responsible for:</p>
                            <ul>
                                <li>Providing accurate and complete information</li>
                                <li>Verifying job details before applying</li>
                                <li>Ensuring eligibility criteria compliance</li>
                            </ul>
                        </div>

                        <div class="section-block">
                            <div class="section-heading">
                                <span class="section-num">6</span>
                                <h5>Limitation of Liability</h5>
                            </div>
                            <p>National EduPortal Hub shall not be held liable for any loss, damage, delay, misunderstanding, or dispute arising from use of this platform or reliance on any published information.</p>
                        </div>

                        <div class="section-block">
                            <div class="section-heading">
                                <span class="section-num">7</span>
                                <h5>Changes to Terms</h5>
                            </div>
                            <p>We reserve the right to modify or update these Terms at any time without prior notice.</p>
                        </div>

                        <div class="section-block">
                            <div class="section-heading">
                                <span class="section-num">8</span>
                                <h5>Acceptance</h5>
                            </div>
                            <p>By using this platform, users acknowledge that they have read, understood, and agreed to these Terms &amp; Conditions.</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="other-pages">
                    <h6 class="fw-bold mb-3" style="color:var(--dark);"><i class="fas fa-book-open me-2" style="color:var(--royal-blue);"></i>Legal Pages</h6>
                    <a href="{{ route('privacy') }}" class="page-link-card">
                        <div class="page-link-icon" style="background:rgba(16,185,129,0.1);color:#059669;"><i class="fas fa-shield-alt"></i></div>
                        <div><div class="fw-bold" style="font-size:0.9rem;">Privacy Policy</div><small class="text-muted">Data collection & use</small></div>
                        <i class="fas fa-chevron-right ms-auto text-muted" style="font-size:0.75rem;"></i>
                    </a>
                    <a href="{{ route('refund') }}" class="page-link-card">
                        <div class="page-link-icon" style="background:rgba(245,158,11,0.1);color:#D97706;"><i class="fas fa-undo"></i></div>
                        <div><div class="fw-bold" style="font-size:0.9rem;">Refund Policy</div><small class="text-muted">Fee refund terms</small></div>
                        <i class="fas fa-chevron-right ms-auto text-muted" style="font-size:0.75rem;"></i>
                    </a>
                    <a href="{{ route('disclaimer') }}" class="page-link-card">
                        <div class="page-link-icon" style="background:rgba(139,92,246,0.1);color:#7C3AED;"><i class="fas fa-exclamation-circle"></i></div>
                        <div><div class="fw-bold" style="font-size:0.9rem;">Disclaimer</div><small class="text-muted">Important notices</small></div>
                        <i class="fas fa-chevron-right ms-auto text-muted" style="font-size:0.75rem;"></i>
                    </a>
                </div>

                <div class="other-pages mt-3">
                    <h6 class="fw-bold mb-3" style="color:var(--dark);"><i class="fas fa-university me-2" style="color:var(--royal-blue);"></i>Bank Details</h6>
                    <div style="font-size:0.85rem;line-height:1.9;color:var(--gray);">
                        <div><strong style="color:var(--dark);">Bank:</strong> Faysal Bank</div>
                        <div><strong style="color:var(--dark);">Account Title:</strong> National EduPortal Hub</div>
                        <div><strong style="color:var(--dark);">Account No:</strong> 3546499000004682</div>
                        <div><strong style="color:var(--dark);">IBAN:</strong> PK69FAYS3546499000004682</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
