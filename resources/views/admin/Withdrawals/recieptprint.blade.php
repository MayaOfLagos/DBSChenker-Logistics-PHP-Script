@extends('layouts.app1')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Withdrawal Receipt</h5>
    </div>
    <div class="card-body">
        <x-danger-alert />
        <x-success-alert />
        <p class="text-muted">Withdrawal Receipt management page.</p>
    </div>
</div>
@endsection
