@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Send Email to Users</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('sendmailtoall') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select class="form-control" id="category" name="category">
                    <option value="All">All Users</option>
                    <option value="Select Users">Choose Specific Users</option>
                </select>
            </div>

            <div class="mb-3 d-none" id="select-user-view">
                <label class="form-label">Select Users (<span class="text-primary fw-bold" id="numofusers">0</span>)</label>
                <select onchange="SelectPage(this)" name="users[]" multiple class="form-control select2" style="width:100%" id="showusers"></select>
            </div>

            <div class="mb-3">
                <label class="form-label">Greeting / Title</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="greet" value="Hello" aria-label="Greeting">
                    <input type="text" class="form-control" name="title" placeholder="Investor" aria-label="Title">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Subject <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="subject" placeholder="Email subject" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Message <span class="text-danger">*</span></label>
                <textarea id="message-editor" name="message" rows="8" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send me-1"></i> Send
            </button>
        </form>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs5.min.js"></script>
<script>
$(document).ready(function() {
    $('#message-editor').summernote({
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview']],
        ],
        placeholder: 'Write your message here...',
    });

    var category = document.getElementById('category');

    category.addEventListener('change', function() {
        if (this.value === 'Select Users') {
            document.getElementById('select-user-view').classList.remove('d-none');
            var users = document.getElementById('showusers');
            users.innerHTML = '';
            fetch("{{ route('fetchusers') }}")
                .then(r => r.json())
                .then(data => {
                    data.data.forEach(function(el) {
                        var opt = document.createElement('option');
                        opt.value = el.id;
                        opt.textContent = el.name;
                        users.appendChild(opt);
                    });
                });
        } else {
            document.getElementById('select-user-view').classList.add('d-none');
        }
    });
});

function SelectPage(elem) {
    var count = Array.from(elem.options).filter(o => o.selected).length;
    document.getElementById('numofusers').textContent = count;
}
</script>
@endpush
