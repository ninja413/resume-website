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
    @if($blogs->isEmpty())
        <div class="alert alert-info">
            This user hasn't published any blog posts yet.
        </div>
    @else
        @foreach($blogs as $blog)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    {{-- Blog Title --}}
                    <h4 class="card-title">
                        <a href="{{ route('blog.public.show', ['username' => $username, 'id' => $blog->id]) }}">{{ $blog->title }}</a>
                    </h4>

                    {{-- Meta --}}
                    <p class="text-muted mb-2">
                        Category: <span class="badge bg-primary">{{ $blog->category->name ?? 'Uncategorized' }}</span> |
                        Published on {{ $blog->created_at->format('d M Y') }}
                    </p>

                    {{-- Image preview --}}
                    @if ($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}"
                             alt="Blog Image"
                             class="img-fluid rounded mb-3"
                             style="max-height: 200px; object-fit: cover;">
                    @endif

                    {{-- Excerpt --}}
                    <p>{!! Str::limit(strip_tags($blog->content), 200) !!}</p>

                    <a href="{{ route('blog.public.show', ['username' => $username, 'id' => $blog->id]) }}" class="btn btn-sm btn-primary">
                        Read More
                    </a>
                </div>
            </div>
        @endforeach
    @endif

</div>
@endsection
