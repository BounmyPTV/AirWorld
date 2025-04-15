@extends('layout.template')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4" style="width: 100%; max-width: 500px;">
        <form action="@yield('form-action')" method="post">
            @csrf
            @yield('form-content')
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        @error("invalid")
        <div class="alert alert-danger mt-3">{{ $message }}</div>
        @enderror
    </div>
</div>

@endsection