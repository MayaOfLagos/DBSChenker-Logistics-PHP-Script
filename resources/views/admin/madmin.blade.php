@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Managers List</h5>
        <a href="{{ route('addmanager') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Add Manager
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->firstName }}</td>
                            <td>{{ $admin->lastName }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone }}</td>
                            <td>{{ $admin->type }}</td>
                            <td>
                                @if($admin->acnt_type_active == 'blocked')
                                    <span class="badge bg-danger">Blocked</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if($admin->acnt_type_active == null || $admin->acnt_type_active == 'blocked')
                                            <li><a class="dropdown-item text-success" href="{{ url('admin/dashboard/unblock') }}/{{ $admin->id }}">Unblock</a></li>
                                        @else
                                            <li><a class="dropdown-item text-danger" href="{{ url('admin/dashboard/ublock') }}/{{ $admin->id }}">Block</a></li>
                                        @endif
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#resetModal{{ $admin->id }}">Reset Password</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $admin->id }}">Edit</a></li>
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mailModal{{ $admin->id }}">Send Email</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $admin->id }}">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        {{-- Reset Password Modal --}}
                        <div id="resetModal{{ $admin->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog"><div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Reset Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Reset password for <strong>{{ $admin->firstName }}</strong> to <span class="text-primary fw-bold">admin01236</span>?</p>
                                    <a class="btn btn-danger" href="{{ url('admin/dashboard/resetadpwd') }}/{{ $admin->id }}">Reset Now</a>
                                </div>
                            </div></div>
                        </div>

                        {{-- Delete Modal --}}
                        <div id="deleteModal{{ $admin->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog"><div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Manager</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Delete <strong>{{ $admin->firstName }}</strong>?</p>
                                    <a class="btn btn-danger" href="{{ url('admin/dashboard/deleletadmin') }}/{{ $admin->id }}">Yes, Delete</a>
                                </div>
                            </div></div>
                        </div>

                        {{-- Edit Modal --}}
                        <div id="editModal{{ $admin->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog"><div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Manager</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('editadmin') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $admin->id }}">
                                        <div class="mb-2"><label class="form-label">First Name</label>
                                            <input class="form-control" type="text" name="fname" value="{{ $admin->firstName }}" required></div>
                                        <div class="mb-2"><label class="form-label">Last Name</label>
                                            <input class="form-control" type="text" name="l_name" value="{{ $admin->lastName }}" required></div>
                                        <div class="mb-2"><label class="form-label">Email</label>
                                            <input class="form-control" type="email" name="email" value="{{ $admin->email }}" required></div>
                                        <div class="mb-2"><label class="form-label">Phone</label>
                                            <input class="form-control" type="text" name="phone" value="{{ $admin->phone }}" required></div>
                                        <div class="mb-3"><label class="form-label">Type</label>
                                            <select class="form-control" name="type">
                                                <option>{{ $admin->type }}</option>
                                                <option>Super Admin</option>
                                                <option>Admin</option>
                                                <option>Conversion Agent</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-info">Update Account</button>
                                    </form>
                                </div>
                            </div></div>
                        </div>

                        {{-- Email Modal --}}
                        <div id="mailModal{{ $admin->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog"><div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Send Email to {{ $admin->firstName }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('sendmailtoadmin') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $admin->id }}">
                                        <div class="mb-3"><label class="form-label">Subject</label>
                                            <input type="text" name="subject" class="form-control" required></div>
                                        <div class="mb-3"><label class="form-label">Message</label>
                                            <textarea class="form-control" name="message" rows="4" required></textarea></div>
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </form>
                                </div>
                            </div></div>
                        </div>
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
