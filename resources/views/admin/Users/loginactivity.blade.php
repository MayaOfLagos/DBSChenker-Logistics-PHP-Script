@extends('layouts.app1')
@section('title', $title)

@section('content')
<div class="card mb-3">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">
      <i class="bi bi-person-circle me-2"></i>{{ $user->name }}
      <span class="badge bg-secondary fw-normal ms-1">{{ $user->email }}</span>
    </h5>
    <div class="d-flex gap-2">
      <a href="{{ route('viewuser', $user->id) }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to User
      </a>
      <a href="{{ route('clearactivity', $user->id) }}"
         class="btn btn-sm btn-outline-danger"
         onclick="return confirm('Clear all login activity for this user?')">
        <i class="bi bi-trash me-1"></i> Clear All
      </a>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0"><i class="bi bi-clock-history me-2"></i>Login Activity</h5>
  </div>
  <div class="card-body p-0">
    @if($activities->isEmpty())
      <div class="text-center text-muted py-5">
        <i class="bi bi-shield-check" style="font-size:2.5rem;"></i>
        <p class="mt-2 mb-0">No login activity recorded for this user.</p>
      </div>
    @else
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
          <thead class="table-dark">
            <tr>
              <th>#</th><th>IP Address</th><th>Device</th><th>Browser</th><th>OS</th><th>Date &amp; Time</th>
            </tr>
          </thead>
          <tbody>
            @foreach($activities as $i => $act)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td><code>{{ $act->ip_address ?? '—' }}</code></td>
                <td>{{ $act->device ?? '—' }}</td>
                <td>{{ $act->browser ?? '—' }}</td>
                <td>{{ $act->os ?? '—' }}</td>
                <td>{{ \Carbon\Carbon::parse($act->created_at)->format('M d, Y  H:i') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</div>
@endsection
