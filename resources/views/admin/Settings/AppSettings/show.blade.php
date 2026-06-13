@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">App Settings</h5>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs mb-3" id="appSettingsTabs">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info">Website Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pref-tab" data-bs-toggle="tab" href="#pref">Preference</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="email-tab" data-bs-toggle="tab" href="#email">Email / Google</a>
            </li>
        </ul>

        <div class="tab-content">
            {{-- Website Info Tab --}}
            <div class="tab-pane fade show active" id="info">
                <form method="POST" action="{{ route('updatewebinfo') }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Website Name</label>
                            <input type="text" class="form-control" name="site_name" value="{{ $settings->site_name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Website Title</label>
                            <input type="text" class="form-control" name="site_title" value="{{ $settings->site_title }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Website URL</label>
                            <input type="text" class="form-control" name="site_address" placeholder="https://yoursite.com" value="{{ $settings->site_address }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Office Address</label>
                            <input type="text" class="form-control" name="locations" value="{{ $settings->locations }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">WhatsApp Number <small class="text-danger">(leave empty to disable)</small></label>
                            <input type="text" class="form-control" name="whatsapp" value="{{ $settings->whatsapp }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tido Livechat ID <small class="text-danger">(leave empty to disable)</small></label>
                            <input type="text" class="form-control" name="tido" value="{{ $settings->tido }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Year Started</label>
                            <input type="text" class="form-control" name="twak" value="{{ $settings->twak }}" placeholder="Year site started">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Email</label>
                            <input type="email" class="form-control" name="contact_email" value="{{ $settings->contact_email }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Favicon</label>
                            <input type="file" class="form-control" name="favicon" accept="image/*,.ico">
                            @if($settings->favicon)
                                <img src="{{ asset('storage/' . $settings->favicon) }}" class="mt-2" style="height:40px;" alt="favicon">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Site Logo</label>
                            <input type="file" class="form-control" name="logo" accept="image/*">
                            @if($settings->logo ?? null)
                                <img src="{{ asset('storage/' . $settings->logo) }}" class="mt-2" style="height:40px;" alt="logo">
                            @endif
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Website Info
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Preference Tab --}}
            <div class="tab-pane fade" id="pref">
                <form method="POST" action="{{ route('updatepreference') }}" id="updatepreference">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Default Currency Symbol</label>
                            <input type="text" class="form-control" name="s_currency" value="{{ $settings->s_currency }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Currency</label>
                            <input type="text" class="form-control" name="currency" value="{{ $settings->currency }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Google Translate</label>
                            <select class="form-control" name="google_translate">
                                <option value="on" {{ $settings->google_translate == 'on' ? 'selected' : '' }}>On</option>
                                <option value="off" {{ $settings->google_translate == 'off' ? 'selected' : '' }}>Off</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Preferences
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Email / Google Tab --}}
            <div class="tab-pane fade" id="email">
                <form method="POST" action="{{ route('updateemailpreference') }}" id="emailform">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Mail Server</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="server" id="sendmailserver" value="sendmail" checked>
                                    <label class="form-check-label" for="sendmailserver">Sendmail</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="server" id="smtpserver" value="smtp">
                                    <label class="form-check-label" for="smtpserver">SMTP</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email From</label>
                            <input type="email" class="form-control" name="emailfrom" value="{{ $settings->emailfrom }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email From Name</label>
                            <input type="text" class="form-control" name="emailfromname" value="{{ $settings->emailfromname }}" required>
                        </div>
                        <div class="col-md-6 smtp d-none">
                            <label class="form-label">SMTP Host</label>
                            <input type="text" class="form-control smtp-input" name="smtp_host" value="{{ $settings->smtp_host }}">
                        </div>
                        <div class="col-md-6 smtp d-none">
                            <label class="form-label">SMTP Port</label>
                            <input type="text" class="form-control smtp-input" name="smtp_port" value="{{ $settings->smtp_port }}">
                        </div>
                        <div class="col-md-6 smtp d-none">
                            <label class="form-label">SMTP Encryption</label>
                            <input type="text" class="form-control smtp-input" name="smtp_encrypt" value="{{ $settings->smtp_encrypt }}">
                        </div>
                        <div class="col-md-6 smtp d-none">
                            <label class="form-label">SMTP Username</label>
                            <input type="text" class="form-control smtp-input" name="smtp_user" value="{{ $settings->smtp_user }}">
                        </div>
                        <div class="col-md-6 smtp d-none">
                            <label class="form-label">SMTP Password</label>
                            <input type="password" class="form-control smtp-input" name="smtp_password" value="{{ $settings->smtp_password }}">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Save Email Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var sendmailRadio = document.getElementById('sendmailserver');
    var smtpRadio = document.getElementById('smtpserver');
    var smtpFields = document.querySelectorAll('.smtp');

    function toggleSmtp() {
        if (smtpRadio && smtpRadio.checked) {
            smtpFields.forEach(function(el) { el.classList.remove('d-none'); });
        } else {
            smtpFields.forEach(function(el) { el.classList.add('d-none'); });
        }
    }

    if (sendmailRadio) sendmailRadio.addEventListener('change', toggleSmtp);
    if (smtpRadio) smtpRadio.addEventListener('change', toggleSmtp);
    toggleSmtp();
});
</script>
@endpush
