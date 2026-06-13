@extends('layouts.app1')
@section('title', $title)

@section('content')
<x-danger-alert />
<x-success-alert />

<div class="card mb-3">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">
      <i class="bi bi-person-circle me-2"></i>{{ $user->name }}
      <span class="badge bg-secondary fw-normal ms-1">{{ $user->email }}</span>
    </h5>
    <a href="{{ route('viewuser', $user->id) }}" class="btn btn-sm btn-outline-secondary">
      <i class="bi bi-arrow-left me-1"></i> Back to User
    </a>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0"><i class="bi bi-journal-text me-2"></i>User Plans</h5>
  </div>
  <div class="card-body p-0">
    @if($plans->isEmpty())
      <div class="text-center text-muted py-5">
        <i class="bi bi-journal-x" style="font-size:2.5rem;"></i>
        <p class="mt-2 mb-0">No plans assigned to this user.</p>
      </div>
    @else
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
          <thead class="table-dark">
            <tr>
              <th>#</th><th>Plan</th><th>Amount</th><th>Status</th><th>Active</th><th>Created</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($plans as $i => $plan)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $plan->plan ?? '—' }}</td>
                <td>${{ number_format($plan->amount ?? 0, 2) }}</td>
                <td>{{ $plan->status ?? '—' }}</td>
                <td>
                  <span class="badge {{ $plan->active === 'yes' ? 'bg-success' : 'bg-secondary' }}">
                    {{ $plan->active === 'yes' ? 'Active' : 'Inactive' }}
                  </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($plan->created_at)->format('M d, Y') }}</td>
                <td class="d-flex gap-1">
                  <a href="{{ route('markas', ['yes', $plan->id]) }}" class="btn btn-xs btn-success btn-sm">Activate</a>
                  <a href="{{ route('markas', ['no', $plan->id]) }}" class="btn btn-xs btn-warning btn-sm text-dark">Deactivate</a>
                  <a href="{{ route('deleteplan', $plan->id) }}" class="btn btn-xs btn-danger btn-sm"
                     onclick="return confirm('Delete this plan?')">Delete</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</div>
@endsection
