@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2>Create New Blog Post</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            Please fix the following issues:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
                <option disabled selected>-- Choose Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Image Upload -->
        <div class="mb-3">
            <label class="form-label">Feature Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- Content -->
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control tinymce" rows="10">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Publish</button>
        <a href="{{ route('blog.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce',
        height: 300,
        plugins: 'image link lists preview',
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | preview',
        menubar: false,
        branding: false,
        images_upload_url: '{{ route('blog.uploadImage') }}',
        images_upload_credentials: true,
        relative_urls: false,
        convert_urls: false,
        setup: (editor) => {
            editor.on('change', () => {
                editor.save();
            });
        }
    });
</script>
@endpush
