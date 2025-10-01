@extends('layouts.app')

@section('title', 'Register - Laravel CRUD')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Create your account</h4>
            </div>
            <div class="card-body">
                <p class="text-center mb-4">
                    Or
                    <a href="{{ route('login') }}" class="text-decoration-none">
                        sign in to your existing account
                    </a>
                </p>
                
                <form action="{{ route('register_action') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full name</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}" required autocomplete="name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" required autocomplete="email">
                 
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               required autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                               required autocomplete="new-password">
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p class="mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Create account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
