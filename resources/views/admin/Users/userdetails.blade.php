@extends('layouts.app1')
@section('title', $title)

@section('content')
<x-danger-alert />
<x-success-alert />

{{-- ── Top action bar ─────────────────────────────────────────────────── --}}
<div class="card mb-3">
  <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
    <h5 class="card-title mb-0">
      <i class="bi bi-person-circle me-1"></i> {{ $user->name }}
      <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }} ms-1">
        {{ ucfirst($user->status) }}
      </span>
    </h5>
    <div class="d-flex flex-wrap gap-2">
      <a href="{{ url('admin/dashboard/customers') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Customers
      </a>
      <a href="{{ route('loginactivity', $user->id) }}" class="btn btn-sm btn-outline-info">
        <i class="bi bi-clock-history me-1"></i> Login Activity
      </a>
      <a href="{{ url('admin/dashboard/switchuser/' . $user->id) }}" class="btn btn-sm btn-outline-warning"
         onclick="return confirm('You will be logged in as {{ $user->name }}. Continue?')">
        <i class="bi bi-box-arrow-in-right me-1"></i> Access Account
      </a>
      @if($user->status === 'active')
        <a href="{{ url('admin/dashboard/uublock/' . $user->id) }}" class="btn btn-sm btn-danger"
           onclick="return confirm('Block {{ $user->name }}?')">
          <i class="bi bi-slash-circle me-1"></i> Block
        </a>
      @else
        <a href="{{ url('admin/dashboard/uunblock/' . $user->id) }}" class="btn btn-sm btn-success"
           onclick="return confirm('Unblock {{ $user->name }}?')">
          <i class="bi bi-check-circle me-1"></i> Unblock
        </a>
      @endif
      <a href="{{ url('admin/dashboard/delsystemuser/' . $user->id) }}" class="btn btn-sm btn-outline-danger"
         onclick="return confirm('Permanently delete {{ $user->name }} and all their data?')">
        <i class="bi bi-trash me-1"></i> Delete User
      </a>
    </div>
  </div>
</div>

<div class="row g-3">
  {{-- ── Left column: User info + quick actions ──────────────────────── --}}
  <div class="col-lg-4">

    {{-- Quick actions --}}
    <div class="card mb-3">
      <div class="card-header"><h6 class="card-title mb-0"><i class="bi bi-lightning me-1"></i> Quick Actions</h6></div>
      <div class="card-body d-flex flex-wrap gap-2">
        <a href="{{ route('emailverify', $user->id) }}" class="btn btn-sm btn-outline-success"
           onclick="return confirm('Manually verify email for {{ $user->name }}?')">
          <i class="bi bi-envelope-check me-1"></i> Verify Email
        </a>
        <a href="{{ route('resetpswd', $user->id) }}" class="btn btn-sm btn-outline-secondary"
           onclick="return confirm('Reset password to default for {{ $user->name }}?')">
          <i class="bi bi-key me-1"></i> Reset Password
        </a>
        <a href="{{ route('clearacct', $user->id) }}" class="btn btn-sm btn-outline-danger"
           onclick="return confirm('Clear all account balances for {{ $user->name }}?')">
          <i class="bi bi-eraser me-1"></i> Clear Account
        </a>
        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#emailModal">
          <i class="bi bi-envelope me-1"></i> Send Email
        </button>
        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#receiptModal">
          <i class="bi bi-printer me-1"></i> Print Receipt
        </button>
      </div>
    </div>

    {{-- User info summary --}}
    <div class="card mb-3">
      <div class="card-header"><h6 class="card-title mb-0"><i class="bi bi-info-circle me-1"></i> Account Info</h6></div>
      <div class="card-body p-0">
        <table class="table table-sm mb-0">
          <tr><th class="ps-3 text-muted" style="width:40%">Email</th><td>{{ $user->email }}</td></tr>
          <tr><th class="ps-3 text-muted">Phone</th><td>{{ $user->phone ?? '—' }}</td></tr>
          <tr><th class="ps-3 text-muted">Country</th><td>{{ $user->country ?? '—' }}</td></tr>
          <tr><th class="ps-3 text-muted">Tracking No.</th><td><code>{{ $user->trackingnumber ?? '—' }}</code></td></tr>
          <tr><th class="ps-3 text-muted">Email Verified</th>
            <td>
              @if($user->email_verified_at)
                <span class="badge bg-success">Verified</span>
              @else
                <span class="badge bg-warning text-dark">Unverified</span>
              @endif
            </td>
          </tr>
          <tr><th class="ps-3 text-muted">Joined</th><td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</td></tr>
        </table>
      </div>
    </div>

    {{-- Shipment summary --}}
    <div class="card">
      <div class="card-header"><h6 class="card-title mb-0"><i class="bi bi-box-seam me-1"></i> Shipment Summary</h6></div>
      <div class="card-body p-0">
        <table class="table table-sm mb-0">
          <tr><th class="ps-3 text-muted" style="width:50%">From</th><td>{{ $user->take_off_point ?? $user->address ?? '—' }}</td></tr>
          <tr><th class="ps-3 text-muted">To</th><td>{{ $user->final_destination ?? $user->saddress ?? '—' }}</td></tr>
          <tr><th class="ps-3 text-muted">Freight Type</th><td>{{ $user->freight_type ?? '—' }}</td></tr>
          <tr><th class="ps-3 text-muted">Weight</th><td>{{ $user->weight ?? '—' }}</td></tr>
          <tr><th class="ps-3 text-muted">Qty</th><td>{{ $user->qty ?? '—' }}</td></tr>
          <tr><th class="ps-3 text-muted">Date Shipped</th><td>{{ $user->date_shipped ? \Carbon\Carbon::parse($user->date_shipped)->format('M d, Y') : '—' }}</td></tr>
          <tr><th class="ps-3 text-muted">Expected Delivery</th><td>{{ $user->expected_delivery ? \Carbon\Carbon::parse($user->expected_delivery)->format('M d, Y') : '—' }}</td></tr>
          <tr><th class="ps-3 text-muted">Shipment Cost</th><td>${{ number_format($user->cost ?? 0, 2) }}</td></tr>
          <tr><th class="ps-3 text-muted">Clearance Cost</th><td>${{ number_format($user->clearance_cost ?? 0, 2) }}</td></tr>
          <tr><th class="ps-3 text-muted">Progress</th>
            <td>
              <div class="progress" style="height:8px;">
                <div class="progress-bar bg-success" style="width:{{ $user->percentage_complete ?? 0 }}%"></div>
              </div>
              <small>{{ $user->percentage_complete ?? 0 }}%</small>
            </td>
          </tr>
        </table>
      </div>
    </div>

  </div>

  {{-- ── Right column: Edit form + tracking history ───────────────────── --}}
  <div class="col-lg-8">

    {{-- Edit user form --}}
    <div class="card mb-3">
      <div class="card-header">
        <h6 class="card-title mb-0"><i class="bi bi-pencil-square me-1"></i> Edit User Details</h6>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('edituser') }}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone</label>
              <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Tracking Number</label>
              <input type="text" name="trackingnumber" value="{{ $user->trackingnumber }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="blocked" {{ $user->status === 'blocked' ? 'selected' : '' }}>Blocked</option>
                <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Freight Type</label>
              <input type="text" name="freight_type" value="{{ $user->freight_type }}" class="form-control">
            </div>

            <div class="col-12"><h6 class="text-muted border-bottom pb-1 mt-1">Sender Info</h6></div>
            <div class="col-md-4">
              <label class="form-label">Sender Name</label>
              <input type="text" name="sname" value="{{ $user->sname }}" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">Sender Email</label>
              <input type="email" name="semail" value="{{ $user->semail }}" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">Sender Phone</label>
              <input type="text" name="sphone" value="{{ $user->sphone }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Origin / Address</label>
              <input type="text" name="address" value="{{ $user->address }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Sender Country</label>
              <input type="text" name="scountry" value="{{ $user->scountry }}" class="form-control">
            </div>

            <div class="col-12"><h6 class="text-muted border-bottom pb-1 mt-1">Receiver Info</h6></div>
            <div class="col-md-6">
              <label class="form-label">Destination / Address</label>
              <input type="text" name="saddress" value="{{ $user->saddress }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Receiver Country</label>
              <input type="text" name="country" value="{{ $user->country }}" class="form-control">
            </div>

            <div class="col-12"><h6 class="text-muted border-bottom pb-1 mt-1">Shipment Details</h6></div>
            <div class="col-md-3">
              <label class="form-label">Date Shipped</label>
              <input type="date" name="date_shipped" value="{{ $user->date_shipped }}" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label">Expected Delivery</label>
              <input type="date" name="expected_delivery" value="{{ $user->expected_delivery }}" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label">Weight (kg)</label>
              <input type="text" name="weight" value="{{ $user->weight }}" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label">Quantity</label>
              <input type="number" name="qty" value="{{ $user->qty }}" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">Shipment Cost ($)</label>
              <input type="number" step="0.01" name="cost" value="{{ $user->cost }}" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">Clearance Cost ($)</label>
              <input type="number" step="0.01" name="clearance_cost" value="{{ $user->clearance_cost }}" class="form-control">
            </div>
            <div class="col-md-4">
              <label class="form-label">Progress (%)</label>
              <input type="number" name="percentage_complete" min="0" max="100" value="{{ $user->percentage_complete }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Photo</label>
              <input type="file" name="photo" class="form-control" accept="image/*">
              @if($user->photo)
                <img src="{{ asset('storage/photos/' . $user->photo) }}"
                     class="img-thumbnail mt-2" style="max-height:80px;" alt="Current photo">
              @endif
            </div>
          </div>

          <div class="mt-3">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-save me-1"></i> Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- Shipment tracking history --}}
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="card-title mb-0"><i class="bi bi-truck me-1"></i> Shipment Tracking History</h6>
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addHistoryModal">
          <i class="bi bi-plus-circle me-1"></i> Add Update
        </button>
      </div>
      <div class="card-body p-0">
        @if(!isset($trackings) || $trackings->isEmpty())
          <div class="text-center text-muted py-4">
            <i class="bi bi-truck" style="font-size:2rem;"></i>
            <p class="mt-2 mb-0">No tracking history yet.</p>
          </div>
        @else
          <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover mb-0">
              <thead class="table-dark">
                <tr><th>Location</th><th>City</th><th>Country</th><th>Status</th><th>Comment</th><th>Date</th><th></th></tr>
              </thead>
              <tbody>
                @foreach($trackings as $t)
                  <tr>
                    <td>{{ $t->address ?? '—' }}</td>
                    <td>{{ $t->city ?? '—' }}</td>
                    <td>{{ $t->country ?? '—' }}</td>
                    <td>
                      <span class="badge {{ $t->status === 'Delivered' ? 'bg-success' : ($t->status === 'In Transit' ? 'bg-primary' : 'bg-secondary') }}">
                        {{ $t->status }}
                      </span>
                    </td>
                    <td>{{ $t->comment ?? '—' }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->created_at)->format('M d, Y') }}</td>
                    <td>
                      <a href="{{ route('delhistory', $t->id) }}" class="btn btn-sm btn-outline-danger"
                         onclick="return confirm('Delete this tracking entry?')">
                        <i class="bi bi-trash"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>

  </div>
</div>

{{-- ── Modals ──────────────────────────────────────────────────────────── --}}

{{-- Add Tracking History --}}
<div class="modal fade" id="addHistoryModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('addhistory') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="modal-header"><h5 class="modal-title">Add Tracking Update</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Address / Location</label>
            <input type="text" name="address" class="form-control" placeholder="e.g. Hamburg Port" required>
          </div>
          <div class="mb-3">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Country</label>
            <input type="text" name="country" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
              <option value="Pending">Pending</option>
              <option value="In Transit">In Transit</option>
              <option value="At Customs">At Customs</option>
              <option value="Out for Delivery">Out for Delivery</option>
              <option value="Delivered">Delivered</option>
              <option value="On Hold">On Hold</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Progress (%)</label>
            <input type="number" name="percentage_complete" min="0" max="100" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Comment</label>
            <textarea name="comment" class="form-control" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Add Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Send Email --}}
<div class="modal fade" id="emailModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('sendmailtooneuser') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="modal-header"><h5 class="modal-title">Send Email to {{ $user->name }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="bi bi-send me-1"></i> Send</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Print Receipt --}}
<div class="modal fade" id="receiptModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('upgradeaccount') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="modal-header"><h5 class="modal-title">Print Receipt</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select name="method" class="form-select" required>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Cash">Cash</option>
              <option value="Card">Card</option>
              <option value="Crypto">Crypto</option>
              <option value="PayPal">PayPal</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Amount ($)</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="bi bi-printer me-1"></i> Generate Receipt</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
