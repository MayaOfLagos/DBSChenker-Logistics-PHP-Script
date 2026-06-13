@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">{{ $settings->site_name }} KYC Applications</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>User</th>
                        <th>KYC Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kycs as $list)
                        <tr>
                            <td>{{ $list->user->name }}</td>
                            <td>
                                @if($list->status == 'Verified')
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-danger">{{ $list->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('viewkyc', $list->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye me-1"></i> View Application
                                </a>
                            </td>
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
