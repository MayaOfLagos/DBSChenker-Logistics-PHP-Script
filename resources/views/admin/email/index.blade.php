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
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">
<style>
  .ck-editor__editable { min-height: 300px; }
  [data-bs-theme="dark"] .ck.ck-editor__main>.ck-editor__editable,
  [data-bs-theme="dark"] .ck.ck-toolbar,
  [data-bs-theme="dark"] .ck.ck-toolbar__separator { background: #1e293b !important; color: #e2e8f0 !important; border-color: #334155 !important; }
  [data-bs-theme="dark"] .ck.ck-button { color: #e2e8f0 !important; }
  [data-bs-theme="dark"] .ck.ck-button:hover, [data-bs-theme="dark"] .ck.ck-button.ck-on { background: #334155 !important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.umd.js"></script>
<script>
(function () {
    const {
        ClassicEditor, Essentials, Autoformat, Bold, Italic, Underline, Strikethrough,
        Paragraph, Heading, Link, List, BlockQuote, Indent, FontSize, FontColor,
        PasteFromOffice, TextTransformation
    } = CKEDITOR;

    ClassicEditor
        .create(document.querySelector('#message-editor'), {
            plugins: [
                Essentials, Autoformat, Bold, Italic, Underline, Strikethrough,
                Paragraph, Heading, Link, List, BlockQuote, Indent,
                FontSize, FontColor, PasteFromOffice, TextTransformation
            ],
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'fontSize', 'fontColor', '|',
                    'link', 'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', 'blockQuote', '|',
                    'undo', 'redo'
                ]
            },
            placeholder: 'Write your message here...'
        })
        .then(editor => {
            window._ckEditor = editor;
            document.querySelector('form').addEventListener('submit', () => {
                editor.updateSourceElement();
            });
        })
        .catch(error => console.error(error));

    document.getElementById('category').addEventListener('change', function () {
        var wrap = document.getElementById('select-user-view');
        if (this.value === 'Select Users') {
            wrap.classList.remove('d-none');
            var users = document.getElementById('showusers');
            users.innerHTML = '';
            fetch("{{ route('fetchusers') }}")
                .then(r => r.json())
                .then(data => {
                    data.data.forEach(function (el) {
                        var opt = document.createElement('option');
                        opt.value = el.id;
                        opt.textContent = el.name;
                        users.appendChild(opt);
                    });
                });
        } else {
            wrap.classList.add('d-none');
        }
    });
})();

function SelectPage(elem) {
    var count = Array.from(elem.options).filter(o => o.selected).length;
    document.getElementById('numofusers').textContent = count;
}
</script>
@endpush
