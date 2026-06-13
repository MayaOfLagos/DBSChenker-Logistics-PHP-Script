@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Follow Up Members</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Balance</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Inv. Plan</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $list)
                        <tr>
                            <td>{{ $list->id }}</td>
                            <td>${{ $list->account_bal }}</td>
                            <td>{{ $list->name }}</td>
                            <td>{{ $list->l_name }}</td>
                            <td>{{ $list->email }}</td>
                            <td>{{ $list->phone_number }}</td>
                            <td>{{ $list->dplan->name ?? 'NULL' }}</td>
                            <td>{{ $list->status }}</td>
                            <td>{{ \Carbon\Carbon::parse($list->created_at)->toDayDateTimeString() }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $list->id }}">
                                    Edit Status
                                </button>
                            </td>
                        </tr>

                        {{-- Edit Status Modal --}}
                        <div id="editModal{{ $list->id }}" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit User Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('updateuser') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $list->id }}">
                                            <div class="mb-3">
                                                <label class="form-label">User Status</label>
                                                <textarea name="userupdate" rows="5" class="form-control" required>{{ $list->userupdate }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#ShipTable').DataTable({ responsive: true });
});
</script>
@endpush
