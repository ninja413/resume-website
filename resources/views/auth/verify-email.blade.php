@extends('layouts.guest') 

@section('content')
<div class="container py-5" style="max-width: 600px;">

    <!-- Message -->
    <div class="mb-4 text-muted small">
        {{ __("Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.") }}
    </div>

    <!-- Status Message -->
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success small">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <!-- Actions -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <!-- Resend Verification -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link text-decoration-none text-muted">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>
@endsection
