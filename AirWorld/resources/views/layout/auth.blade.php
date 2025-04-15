@extends('layout.template')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">@yield('title')</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="@yield('form-action')">
        @csrf
        @yield('form-content')

        <div class="form-check mb-2">
            <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" class="form-check-label">Remember me</label>
        </div>
        
        <button type="submit" class="btn btn-primary w-100 mt-3">@yield('title')</button>
    </form>
</div>

@endsection