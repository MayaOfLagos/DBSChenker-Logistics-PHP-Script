@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <form action="{{ route('admin.shipments') }}" method="GET" class="d-flex flex-wrap gap-2">
            <input type="text" name="search" class="form-control" style="width:220px;"
                placeholder="Search tracking/name/email..." value="{{ $search ?? '' }}">
            <select name="status" class="form-control" style="width:180px;">
                <option value="">All Statuses</option>
                @foreach(['Order Confirmed','Picked by Courier','On The Way','Custom Hold','Delivered'] as $s)
                    <option value="{{ $s }}" {{ ($status ?? '') == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Filter</button>
            @if(($search ?? '') || ($status ?? ''))
                <a href="{{ route('admin.shipments') }}" class="btn btn-secondary">Clear</a>
            @endif
        </form>
        <a href="{{ route('admin.shipments.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Create Shipment
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Manage Shipments</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>Tracking No.</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Origin &rarr; Destination</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shipments as $shipment)
                        <tr>
                            <td>
                                <a href="{{ route('admin.shipments.view', $shipment->id) }}" class="fw-bold">
                                    {{ $shipment->trackingnumber }}
                                </a>
                            </td>
                            <td>{{ $shipment->sname }}</td>
                            <td>
                                {{ $shipment->name }}
                                <div class="small text-muted">
                                    {{ $shipment->email }}<br>{{ $shipment->phone }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $shipment->take_off_point }}</span>
                                <i class="bi bi-arrow-right mx-1"></i>
                                <span class="badge bg-secondary">{{ $shipment->final_destination }}</span>
                            </td>
                            <td>
                                @if($shipment->status == 'Delivered')
                                    <span class="badge bg-success">{{ $shipment->status }}</span>
                                @elseif($shipment->status == 'Custom Hold')
                                    <span class="badge bg-warning text-dark">{{ $shipment->status }}</span>
                                @else
                                    <span class="badge bg-info text-dark">{{ $shipment->status }}</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($shipment->created_at)->toDayDateTimeString() }}</td>
                            <td>
                                <a href="{{ route('admin.shipments.view', $shipment->id) }}" class="btn btn-info btn-sm me-1" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.shipments.update-status-form', $shipment->id) }}" class="btn btn-primary btn-sm me-1" title="Update Status">
                                    <i class="bi bi-truck"></i>
                                </a>
                                <a href="{{ route('admin.shipments.print', $shipment->id) }}" target="_blank" class="btn btn-secondary btn-sm me-1" title="Print">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <a href="{{ route('admin.delete.shipment', $shipment->id) }}" class="btn btn-danger btn-sm" title="Delete"
                                    onclick="return confirm('Delete this shipment?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-box-seam fs-1 text-muted d-block mb-2"></i>
                                No shipments found.
                                @if(($search ?? '') || ($status ?? ''))
                                    <a href="{{ route('admin.shipments') }}" class="btn btn-sm btn-outline-primary ms-2">Clear Filters</a>
                                @else
                                    <a href="{{ route('admin.shipments.create') }}" class="btn btn-sm btn-primary ms-2">Create Shipment</a>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        {{ $shipments->appends(['search' => $search ?? '', 'status' => $status ?? ''])->links() }}
    </div>
</div>
@endsection
