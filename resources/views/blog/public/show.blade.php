@extends('layouts.public')

@section('content')
<div class="container mt-4">

    <div class="mb-3">
        <a href="{{ route('resume.show', ['username' => $username]) }}" class="btn btn-outline-primary me-2">
            Resume Details
        </a>
        <a href="{{ route('blog.public.index', ['username' => $username]) }}" class="btn btn-outline-secondary">Blog</a>
    </div>

    {{-- Header --}}
    <div class="card border-0 shadow-lg">
        @if ($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" style="max-height: 450px; object-fit: cover;" alt="Blog Image">
        @endif

        <div class="card-body p-5">
            {{-- Title --}}
            <h1 class="fw-bold mb-3">{{ $blog->title }}</h1>

            {{-- Meta --}}
            <div class="d-flex flex-wrap justify-content-between text-muted mb-4">
                <small>
                    By <strong class="text-dark">{{ $blog->user->name ?? 'Unknown' }}</strong>
                </small>
                <small>
                    Category: <span class="badge bg-primary">{{ $blog->category->name ?? 'Uncategorized' }}</span>
                </small>
                <small>
                    Published on {{ $blog->created_at->format('d M Y') }}
                </small>
            </div>

            {{-- Content --}}
            <article class="blog-content fs-5 lh-lg overflow-auto">
                {!! $blog->content !!}
            </article>
        </div>
    </div>

</div>
@endsection
