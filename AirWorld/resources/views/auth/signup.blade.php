@extends('layout.auth')

@section('title', 'Register')
@section('form-action', route('form.register'))

@section('form-content')
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" 
               class="form-control @error('name') is-invalid @enderror" 
               id="name" 
               name="name" 
               placeholder="Enter name" 
               value="{{ old('name') }}" 
               required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" 
               name="email" 
               id="email" 
               value="{{ old('email') }}" 
               class="form-control @error('email') is-invalid @enderror" 
               required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" 
               name="password" 
               id="password" 
               class="form-control @error('password') is-invalid @enderror" 
               required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" 
               name="password_confirmation" 
               id="password_confirmation" 
               class="form-control @error('password_confirmation') is-invalid @enderror" 
               required>
        @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endsection