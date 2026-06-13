@extends('layouts.app1')
@section('content')

  {{-- Action buttons --}}
  <div class="d-flex align-items-center flex-column flex-md-row mb-4">
    @if (Auth('admin')->User()->type == 'Super Admin' || Auth('admin')->User()->type == 'Admin')
      <div class="ms-md-auto mt-3 mt-md-0">
        <a href="{{ route('admin.shipments.create') }}" class="btn btn-success me-2">
          <i class="bi bi-plus-circle me-1"></i> Create Shipment
        </a>
        <a href="{{ route('admin.shipments') }}" class="btn btn-danger">
          <i class="bi bi-truck me-1"></i> Manage Shipments
        </a>
      </div>
    @endif
  </div>

  {{-- Stat Cards (AdminLTE 4 small-box) --}}
  <div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
      <div class="small-box text-bg-primary">
        <div class="inner">
          <h3>{{ number_format($numberOfUsers) }}</h3>
          <p>Total Shipments</p>
        </div>
        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M8 16a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H8Zm0 2h8a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v10a4 4 0 0 0 4 4Z"/>
        </svg>
        <a href="{{ route('admin.shipments') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
          View All <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>
      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="small-box text-bg-success">
        <div class="inner">
          <h3>{{ number_format($active_users) }}</h3>
          <p>Active Shipments</p>
        </div>
        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
        </svg>
        <a href="{{ route('admin.shipments') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
          View All <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>
      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="small-box text-bg-warning">
        <div class="inner">
          <h3>{{ number_format($blockedusers) }}</h3>
          <p>On Hold</p>
        </div>
        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
        </svg>
        <a href="{{ route('admin.shipments') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
          View All <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>
      </div>
    </div>

    <div class="col-6 col-lg-3">
      <div class="small-box text-bg-danger">
        <div class="inner">
          <h3>{{ number_format($subscribers) }}</h3>
          <p>Active Plans</p>
        </div>
        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
        </svg>
        <a href="{{ route('admin.shipments') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
          View All <i class="bi bi-arrow-right-circle ms-1"></i>
        </a>
      </div>
    </div>
  </div>

  {{-- Charts row --}}
  <div class="row g-3">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">Shipment Statistics</h5>
          <span class="badge text-bg-primary">{{ now()->format('Y') }}</span>
        </div>
        <div class="card-body">
          <canvas id="lineChart" style="min-height:250px;"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100">
        <div class="card-header">
          <h5 class="card-title mb-0">Latest Shipments</h5>
        </div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush">
            @forelse ($latestUsers as $user)
              <a href="{{ route('viewuser', ['id' => $user->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                <div>
                  <div class="fw-semibold">{{ $user->trackingnumber }}</div>
                  <small class="text-muted">{{ $user->email }}</small>
                </div>
                <i class="bi bi-arrow-right text-muted"></i>
              </a>
            @empty
              <li class="list-group-item text-muted text-center py-4">No shipments yet.</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  // Shipment statistics line chart (Chart.js 4)
  const userStats = {{ Illuminate\Support\Js::from($usersData) }};
  new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
      labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
      datasets: [{
        label: 'Shipments Made',
        data: userStats,
        borderColor: '#007bff',
        backgroundColor: 'rgba(0,123,255,0.1)',
        pointBackgroundColor: '#007bff',
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
        pointRadius: 4,
        fill: true,
        tension: 0.3,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'bottom', labels: { color: '#666' } },
        tooltip: { mode: 'nearest', intersect: false }
      },
      layout: { padding: 15 }
    }
  });
</script>
@endpush
