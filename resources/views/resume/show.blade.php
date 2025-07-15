@extends('layouts.public')

@section('content')
<div class="container mt-3">
    
    <div class="mb-3">
        <a href="{{ route('resume.show', ['username' => $username]) }}" class="btn btn-outline-primary me-2">
            Resume Details
        </a>
        <a href="{{ route('blog.public.index', ['username' => $username]) }}" class="btn btn-outline-secondary">Blog</a>
    </div>

    <div class="card shadow">
        <div class="card-body m-5">
            <h2 class="text-center mb-5">Username: {{ $username }}</h2>
            <div class="text-center mb-3">
                 @if ($resume->photo)
                    <img src="{{ asset('storage/' . $resume->photo) }}" width="150" class="img-thumbnail mb-3">
                @endif
                <h3>{{ $resume->full_name }}</h3>
                <p><strong>Email:</strong> {{ $resume->email }}</p>
                <p><strong>Phone:</strong> {{ $resume->phone }}</p>
                <p><strong>Address:</strong> {{ $resume->address }}</p>
            </div>
            {!! $resume->resume_body !!}
            
        </div>
    </div>
</div>
@endsection
