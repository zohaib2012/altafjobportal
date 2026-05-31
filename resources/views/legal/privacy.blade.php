@extends('layouts.app')

@section('title', 'Privacy Policy')

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
.legal-icon-wrap { width: 72px; height: 72px; background: rgba(255,255,255,0.12); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; font-size: 1.75rem; color: #FCD34D; }
.legal-body { padding: 60px 0 80px; background: var(--light-bg); }
.legal-card { background: var(--white); border-radius: 20px; box-shadow: var(--shadow-lg); border: 1px solid var(--gray-light); overflow: hidden; }
.legal-nav { background: linear-gradient(135deg, var(--primary-navy), #1E3A8A); padding: 1.25rem 1.5rem; display: flex; flex-wrap: wrap; gap: 0.5rem; }
.legal-nav a { color: rgba(255,255,255,0.75); font-size: 0.82rem; font-weight: 600; padding: 0.35rem 0.85rem; border-radius: 8px; background: rgba(255,255,255,0.08); transition: all 0.2s; }
.legal-nav a:hover, .legal-nav a.active { color: #FCD34D; background: rgba(252,211,77,0.12); }
.legal-content { padding: 2.5rem; }
.section-block { margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 1px solid var(--gray-light); }
.section-block:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
.section-num { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: linear-gradient(135deg, var(--royal-blue), var(--primary-blue)); color: white; border-radius: 8px; font-size: 0.8rem; font-weight: 700; flex-shrink: 0; margin-right: 0.75rem; }
.section-heading { display: flex; align-items: center; margin-bottom: 1rem; }
.section-heading h5 { font-size: 1.05rem; font-weight: 700; color: var(--dark); margin: 0; }
.legal-content p, .legal-content li { font-size: 0.95rem; line-height: 1.8; color: var(--gray); }
.legal-content ul { padding-left: 1.25rem; margin-top: 0.5rem; }
.legal-content ul li { margin-bottom: 0.35rem; }
.other-pages { background: var(--white); border: 1px solid var(--gray-light); border-radius: 16px; padding: 1.5rem; }
.page-link-card { display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; border: 1px solid var(--gray-light); transition: all 0.25s; color: var(--dark); margin-bottom: 0.75rem; text-decoration: none; }
.page-link-card:last-child { margin-bottom: 0; }
.page-link-card:hover { border-color: var(--royal-blue); background: rgba(59,130,246,0.04); transform: translateX(4px); color: var(--royal-blue); }
.page-link-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
</style>
@endsection

@section('content')
<div class="legal-hero text-center text-white">
    <div class="container position-relative" style="z-index:2;">
        <div class="legal-icon-wrap"><i class="fas fa-shield-alt"></i></div>
        <h1 class="fw-bold mb-2" style="font-size:2rem;">Privacy Policy</h1>
        <p style="opacity:0.85;font-size:1rem;">Last updated: {{ date('F Y') }}</p>
    </div>
</div>

<div class="legal-body">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="legal-card">
                    <div class="legal-nav">
                        <a href="{{ route('terms') }}"><i class="fas fa-file-contract me-1"></i>Terms</a>
                        <a href="{{ route('privacy') }}" class="active"><i class="fas fa-shield-alt me-1"></i>Privacy Policy</a>
                        <a href="{{ route('refund') }}"><i class="fas fa-undo me-1"></i>Refund Policy</a>
                        <a href="{{ route('disclaimer') }}"><i class="fas fa-exclamation-circle me-1"></i>Disclaimer</a>
                    </div>
                    <div class="legal-content">
                        <div class="section-block">
                            <div class="section-heading"><span class="section-num">1</span><h5>Information We Collect</h5></div>
                            <p>We may collect:</p>
                            <ul>
                                <li>Name, contact details, and email</li>
                                <li>Educational and professional information</li>
                                <li>CV/resume and supporting documents</li>
                                <li>Any information submitted through forms</li>
                            </ul>
                        </div>
                        <div class="section-block">
                            <div class="section-heading"><span class="section-num">2</span><h5>Use of Information</h5></div>
                            <p>Collected data is used for:</p>
                            <ul>
                                <li>Processing job applications</li>
                                <li>Recruitment facilitation</li>
                                <li>Communication with applicants</li>
                                <li>Improving platform services</li>
                            </ul>
                        </div>
                        <div class="section-block">
                            <div class="section-heading"><span class="section-num">3</span><h5>Data Sharing</h5></div>
                            <p>We do not sell personal data. Information may be shared only with:</p>
                            <ul>
                                <li>Hiring organizations</li>
                                <li>Partner recruitment agencies (if required)</li>
                                <li>Legal authorities if required by law</li>
                            </ul>
                        </div>
                        <div class="section-block">
                            <div class="section-heading"><span class="section-num">4</span><h5>Data Security</h5></div>
                            <p>We take reasonable technical and administrative measures to protect user data, but cannot guarantee absolute security due to internet-based transmission risks.</p>
                        </div>
                        <div class="section-block">
                            <div class="section-heading"><span class="section-num">5</span><h5>Cookies &amp; Tracking</h5></div>
                            <p>The website may use cookies to improve user experience and analytics.</p>
                        </div>
                        <div class="section-block">
                            <div class="section-heading"><span class="section-num">6</span><h5>User Consent</h5></div>
                            <p>By using this website, users consent to the collection and use of their information as described in this policy.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="other-pages">
                    <h6 class="fw-bold mb-3" style="color:var(--dark);"><i class="fas fa-book-open me-2" style="color:var(--royal-blue);"></i>Legal Pages</h6>
                    <a href="{{ route('terms') }}" class="page-link-card">
                        <div class="page-link-icon" style="background:rgba(59,130,246,0.1);color:var(--royal-blue);"><i class="fas fa-file-contract"></i></div>
                        <div><div class="fw-bold" style="font-size:0.9rem;">Terms &amp; Conditions</div><small class="text-muted">Platform usage rules</small></div>
                        <i class="fas fa-chevron-right ms-auto text-muted" style="font-size:0.75rem;"></i>
                    </a>
                    <a href="{{ route('refund') }}" class="page-link-card">
                        <div class="page-link-icon" style="background:rgba(59,130,246,0.1);color:var(--royal-blue);"><i class="fas fa-undo"></i></div>
                        <div><div class="fw-bold" style="font-size:0.9rem;">Refund Policy</div><small class="text-muted">Fee refund terms</small></div>
                        <i class="fas fa-chevron-right ms-auto text-muted" style="font-size:0.75rem;"></i>
                    </a>
                    <a href="{{ route('disclaimer') }}" class="page-link-card">
                        <div class="page-link-icon" style="background:rgba(59,130,246,0.1);color:var(--royal-blue);"><i class="fas fa-exclamation-circle"></i></div>
                        <div><div class="fw-bold" style="font-size:0.9rem;">Disclaimer</div><small class="text-muted">Important notices</small></div>
                        <i class="fas fa-chevron-right ms-auto text-muted" style="font-size:0.75rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
