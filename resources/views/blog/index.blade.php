@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">My Blog Posts</h2>

    <div class="mb-3">
        <a href="{{ route('blog.create') }}" class="btn btn-success">+ Create New Post</a>
    </div>

    @if ($blogs->isEmpty())
        <div class="alert alert-info">You haven't written any blog posts yet.</div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th style="width: 180px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->category->name ?? '—' }}</td>
                        <td>{{ $blog->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-primary">Edit</a>

                            <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this post?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>

                            <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-sm btn-secondary">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- If paginated --}}
        {{ $blogs->links() }}
    @endif
</div>
@endsection
