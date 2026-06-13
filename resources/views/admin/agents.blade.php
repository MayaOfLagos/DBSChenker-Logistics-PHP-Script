@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Agents</h5>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addagentModal">
            <i class="bi bi-plus-circle me-1"></i> Add Agent
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>Agent Name</th>
                        <th>Clients Referred</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agents as $agent)
                        <tr>
                            <td>{{ $agent->duser->name }}</td>
                            <td>{{ $agent->total_refered }}</td>
                            <td>
                                <a href="{{ url('admin/dashboard/delagent') }}/{{ $agent->id }}"
                                    class="btn btn-danger btn-sm"
                                    title="Remove Agent"
                                    onclick="return confirm('Remove this agent?')">
                                    <i class="bi bi-person-x"></i> Remove
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Agent Modal --}}
<div id="addagentModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Agent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ action('App\Http\Controllers\Admin\LogicController@addagent') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select User</label>
                        <select class="form-control" name="user">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Referred Users (increment)</label>
                        <input type="number" class="form-control" name="referred_users" min="0" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
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
