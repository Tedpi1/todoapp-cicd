@extends("layout.layout")

@section('content')
<div class="login-wrapper">
    <div class="form-container">
        <div class="header text-center mb-4">
            <h1>Create an Account</h1>
            <p class="text-muted">Join us to start managing your tasks</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control form-control-lg" id="name" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control form-control-lg" id="email" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control form-control-lg" id="password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control form-control-lg" id="password_confirmation" required>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            <button type="submit" class="btn btn-primary btn-lg w-100">Sign Up</button>

            <div class="mt-3 text-center">
                <p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login here</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
