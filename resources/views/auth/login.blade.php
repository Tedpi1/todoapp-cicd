@extends("layout.layout")

@section('content')
<div class="login-wrapper">
    <div class="form-container">
        <div class="header text-center mb-4">
            <h1>Welcome Back</h1>
            <p class="text-muted">Securely access your tasks and notes</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control form-control-lg" id="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control form-control-lg" id="password" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <a href="#" class="text-decoration-none">Forgot Password?</a>
            </div>
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

            <button type="submit" class="btn btn-primary btn-lg w-100">Sign In</button>
            <div class="mt-3 text-center">
                <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Sign up here</a></p>
            </div>
        </form>
    </div>
</div>
@endsection
