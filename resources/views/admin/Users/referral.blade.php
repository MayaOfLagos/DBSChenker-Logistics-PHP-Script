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
    <h5 class="card-title mb-0"><i class="bi bi-people me-2"></i>Assign Referral</h5>
    <small class="text-muted">Select a user to mark as referred by <strong>{{ $user->name }}</strong></small>
  </div>
  <div class="card-body p-0">
    @if($ref->isEmpty())
      <div class="text-center text-muted py-5">
        <i class="bi bi-people" style="font-size:2.5rem;"></i>
        <p class="mt-2 mb-0">No eligible users available to assign.</p>
      </div>
    @else
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
          <thead class="table-dark">
            <tr>
              <th>#</th><th>Name</th><th>Email</th><th>Country</th><th>Status</th><th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ref as $i => $r)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r->name }}</td>
                <td>{{ $r->email }}</td>
                <td>{{ $r->country ?? '—' }}</td>
                <td>
                  <span class="badge {{ $r->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($r->status) }}
                  </span>
                </td>
                <td>
                  <form method="POST" action="{{ route('addref') }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="ref_id" value="{{ $r->id }}">
                    <button type="submit" class="btn btn-sm btn-primary"
                            onclick="return confirm('Mark {{ $r->name }} as referred by {{ $user->name }}?')">
                      <i class="bi bi-person-plus me-1"></i> Assign
                    </button>
                  </form>
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
