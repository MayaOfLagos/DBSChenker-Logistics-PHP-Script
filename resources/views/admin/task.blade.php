@extends('layouts.app1')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Tasks</h5>
    </div>
    <div class="card-body">
        <x-danger-alert />
        <x-success-alert />
        <p class="text-muted">Tasks management page.</p>
    </div>
</div>
@endsection
