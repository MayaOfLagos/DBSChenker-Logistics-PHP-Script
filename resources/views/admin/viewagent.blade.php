@extends('layouts.app1')
@section('content')

@if(session('message'))
    <div class="alert alert-info alert-dismissible fade show">{{ session('message') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
@endif
@if($errors->any())
    <div class="alert alert-danger">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Agent: {{ $agent->name }} &mdash; Clients</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>Client Name</th>
                        <th>Inv. Plan</th>
                        <th>Status</th>
                        <th>Earnings</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ag_r as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->dplan->name ?? 'NULL' }}</td>
                            <td>{{ $client->status }}</td>
                            <td>{{ $client->account_bal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>$(document).ready(function(){ $('#ShipTable').DataTable({ responsive: true }); });</script>
@endpush
