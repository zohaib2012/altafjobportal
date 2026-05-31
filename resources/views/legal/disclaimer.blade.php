@extends('layouts.app')

@section('title', 'Disclaimer')

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
.legal-content p { font-size: 0.95rem; line-height: 1.9; color: var(--gray); margin-bottom: 1.25rem; }
.legal-content p:last-child { margin-bottom: 0; }
.highlight-box { background: rgba(59,130,246,0.05); border: 1.5px solid rgba(59,130,246,0.2); border-radius: 14px; padding: 1.5rem; margin-bottom: 1.5rem; }
.highlight-box p { margin-bottom: 0; color: var(--dark); font-weight: 500; }
.badge-row { display: flex; flex-wrap: wrap; gap: 0.5rem; margin: 1.5rem 0; }
.legal-badge { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.4rem 0.9rem; border-radius: 8px; font-size: 0.8rem; font-weight: 600; }
.other-pages { background: var(--white); border: 1px solid var(--gray-light); border-radius: 16px; padding: 1.5rem; }
.page-link-card { display: flex; align-items: center; gap: 1rem; padding: 1rem; border-radius: 12px; border: 1px solid var(--gray-light); transition: all 0.25s; color: var(--dark); margin-bottom: 0.75rem; text-decoration: none; }
.page-link-card:last-child { margin-bottom: 0; }
.page-link-card:hover { border-color: var(--royal-blue); background: rgba(59,130,246,0.04); transform: translateX(4px); color: var(--royal-blue); }
.page-link-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
.org-footer { background: linear-gradient(135deg, var(--primary-navy), #1E3A8A); border-radius: 14px; padding: 1.5rem; color: white; margin-top: 1.5rem; text-align: center; }
</style>
@endsection

@section('content')
<div class="legal-hero text-center text-white">
    <div class="container position-relative" style="z-index:2;">
        <div class="legal-icon-wrap"><i class="fas fa-exclamation-circle"></i></div>
        <h1 class="fw-bold mb-2" style="font-size:2rem;">Disclaimer</h1>
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
                        <a href="{{ route('privacy') }}"><i class="fas fa-shield-alt me-1"></i>Privacy Policy</a>
                        <a href="{{ route('refund') }}"><i class="fas fa-undo me-1"></i>Refund Policy</a>
                        <a href="{{ route('disclaimer') }}" class="active"><i class="fas fa-exclamation-circle me-1"></i>Disclaimer</a>
                    </div>
                    <div class="legal-content">

                        <div class="highlight-box">
                            <p><i class="fas fa-building me-2" style="color:var(--royal-blue);"></i>National EduPortal Hub is a <strong>privately owned and independently operated</strong> recruitment and career information platform. The organization is registered with the <strong>Federal Board of Revenue (FBR)</strong> and operates in compliance with applicable laws and regulations of Pakistan, and its registration process with the <strong>Securities and Exchange Commission of Pakistan (SECP)</strong> is maintained as per legal requirements.</p>
                        </div>

                        <div class="badge-row">
                            <span class="legal-badge" style="background:rgba(16,185,129,0.1);color:#059669;border:1px solid rgba(16,185,129,0.25);"><i class="fas fa-check-circle"></i> FBR Registered</span>
                            <span class="legal-badge" style="background:rgba(59,130,246,0.1);color:var(--royal-blue);border:1px solid rgba(59,130,246,0.25);"><i class="fas fa-check-circle"></i> SECP Compliant</span>
                            <span class="legal-badge" style="background:rgba(245,158,11,0.1);color:#D97706;border:1px solid rgba(245,158,11,0.25);"><i class="fas fa-lock"></i> Private Platform</span>
                        </div>

                        <p>National EduPortal Hub is <strong>not a government organization</strong>, department, ministry, authority, commission, public sector entity, or official recruitment agency of the Government of Pakistan or any Provincial Government. It has no affiliation, partnership, endorsement, authorization, or representation with any government institution unless explicitly stated in a written agreement.</p>

                        <p>All job advertisements, recruitment notices, and career opportunities published on this website are provided for <strong>informational purposes only</strong> and are collected from employers, organizations, and other sources believed to be reliable. Users are strongly advised to <strong>verify all details independently</strong> before applying.</p>

                        <p>National EduPortal Hub does <strong>not guarantee</strong> employment, selection, interview calls, appointment letters, salaries, or any recruitment outcome. Final hiring decisions are made solely by the respective employer or hiring organization.</p>

                        <p>By using this website, users agree that National EduPortal Hub, its owners, management, employees, and affiliates shall <strong>not be held responsible or liable</strong> for any direct or indirect loss, damage, dispute, or consequence arising from the use of information provided on this platform.</p>

                        <p>The platform reserves the right to update, modify, or remove any content at any time without prior notice.</p>

                        <p>All users are deemed to have read, understood, and accepted this Disclaimer along with the <a href="{{ route('terms') }}" style="color:var(--royal-blue);font-weight:600;">Terms &amp; Conditions</a> and <a href="{{ route('privacy') }}" style="color:var(--royal-blue);font-weight:600;">Privacy Policy</a> of National EduPortal Hub.</p>

                        <div class="org-footer">
                            <div class="fw-bold fs-5 mb-1">National EduPortal Hub</div>
                            <div style="opacity:0.85;font-size:0.9rem;">Private Recruitment &amp; Career Information Portal — Pakistan</div>
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
                    <a href="{{ route('privacy') }}" class="page-link-card">
                        <div class="page-link-icon" style="background:rgba(59,130,246,0.1);color:var(--royal-blue);"><i class="fas fa-shield-alt"></i></div>
                        <div><div class="fw-bold" style="font-size:0.9rem;">Privacy Policy</div><small class="text-muted">Data collection & use</small></div>
                        <i class="fas fa-chevron-right ms-auto text-muted" style="font-size:0.75rem;"></i>
                    </a>
                    <a href="{{ route('refund') }}" class="page-link-card">
                        <div class="page-link-icon" style="background:rgba(59,130,246,0.1);color:var(--royal-blue);"><i class="fas fa-undo"></i></div>
                        <div><div class="fw-bold" style="font-size:0.9rem;">Refund Policy</div><small class="text-muted">Fee refund terms</small></div>
                        <i class="fas fa-chevron-right ms-auto text-muted" style="font-size:0.75rem;"></i>
                    </a>
                </div>

                <div class="other-pages mt-3" style="background:rgba(59,130,246,0.03);border-color:rgba(59,130,246,0.2);">
                    <h6 class="fw-bold mb-3" style="color:var(--dark);"><i class="fas fa-certificate me-2" style="color:var(--royal-blue);"></i>Registrations</h6>
                    <div style="font-size:0.85rem;line-height:2;color:var(--gray);">
                        <div class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-success"></i> <strong>FBR</strong> — Federal Board of Revenue</div>
                        <div class="d-flex align-items-center gap-2"><i class="fas fa-check-circle text-success"></i> <strong>SECP</strong> — Securities &amp; Exchange Commission</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
