@extends('layout.auth')

@section('title', 'Login')

@section('form-action', route('form.login'))

@section('form-content')
<div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@endsection