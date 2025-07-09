@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-semibold fs-4 text-dark">
            {{ Auth::user()->usertype === 'admin' ? 'Admin: '. Auth::user()->name : 'User: '. Auth::user()->name }}
        </h2>
    </div>

    <!-- Card -->
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <p class="text-muted mb-0">
                {{ __("You're logged in!") }}
            </p>
        </div>
    </div>
</div>
@endsection
