@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Page Heading -->
    <div class="mb-4">
        <h2 class="fw-semibold fs-4 text-dark">
            {{ __('Profile') }}
        </h2>
    </div>

    <!-- Update Profile Info -->
    <div class="card mb-4 shadow-sm rounded">
        <div class="card-body">
            <div class="mx-auto" style="max-width: 600px;">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
    </div>

    <!-- Update Password -->
    <div class="card mb-4 shadow-sm rounded">
        <div class="card-body">
            <div class="mx-auto" style="max-width: 600px;">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>

    <!-- Delete User -->
    <div class="card mb-4 shadow-sm rounded">
        <div class="card-body">
            <div class="mx-auto" style="max-width: 600px;">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
