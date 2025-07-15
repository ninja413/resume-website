@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('blog.index') }}" class="btn btn-sm btn-outline-dark">
            ← Back to Blog List
        </a>
    </div>

    {{-- Blog Card --}}
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
            <article class="blog-content fs-5 lh-lg">
                {!! $blog->content !!}
            </article>
        </div>
    </div>
</div>
@endsection
