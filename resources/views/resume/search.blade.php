@extends('layouts.public')

@section('content')

<div class="container mb-5">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>

<div class="container text-center mt-5 mb-5 p-5 bg-light rounded shadow">
    
    <h1>Search Resumes</h1>
    <form action="{{ route('resume.search') }}" method="GET">
        <input type="text" name="q" placeholder="Search by username..." class="form-control mt-3 mb-3" style="width: 300px; margin: auto;">
        <button type="submit" class="btn btn-primary mt-3 mb-3">Search</button>
    </form>
</div>
@endsection
