@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-semibold fs-4 text-dark">
            Resume
        </h2>
    </div>

    <!-- Card -->
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <form action="{{ route('resume.update') }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <!-- Profile Picture -->
                <div class="mb-3">
                    <label class="form-label">Profile Photo</label>
                    <input type="file" name="photo" class="form-control">
                    @if($resume->photo)
                        <img src="{{ asset('storage/' . $resume->photo) }}" class="mt-2" width="100">
                    @endif
                </div>

                <!-- Resume Username -->
                <div class="mb-3">
                    <label class="form-label">Public Resume Username</label>
                    <input type="text" name="resume_username"
                        class="form-control @error('resume_username') is-invalid @enderror"
                        value="{{ old('resume_username', $resume->resume_username) }}"
                        pattern="[a-zA-Z0-9\-]+" required>
                    <div class="form-text">
                        This will be used in the public link. Only letters, numbers, and dashes allowed.
                    </div>
                    @error('resume_username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Full Name -->
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $resume->full_name) }}">
                </div>

                <!-- Email, Phone -->
                <div class="row">
                    <div class="col">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $resume->email) }}">
                    </div>
                    <div class="col">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $resume->phone) }}">
                    </div>
                </div>

                <!-- Address -->
                <div class="mb-3 mt-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control">{{ old('address', $resume->address) }}</textarea>
                </div>

                <!-- Resume Body -->
                <div class="mb-3">
                    <label class="form-label">Resume Content</label>
                    <textarea name="resume_body" class="form-control tinymce">{{ old('resume_body', $resume->resume_body) }}</textarea>
                </div>

                <!-- Public Toggle -->
                <div class="form-check mb-3">
                    <input type="checkbox"
                        class="form-check-input"
                        id="is_public"
                        name="is_public"
                        value="1"
                        {{ empty($resume->resume_username) ? 'disabled' : '' }}
                        {{ old('is_public', $resume->is_public ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_public">
                        Make this resume public
                    </label>

                    @if (empty($resume->resume_username))
                        <div class="form-text text-danger">
                            Please set a public resume username first.
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update Resume</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tinymce',
            plugins: 'lists link',
            toolbar: 'undo redo | bold italic underline | bullist numlist | link',
            menubar: false,
            branding: false,
            height: 300
        });
    </script>
@endpush