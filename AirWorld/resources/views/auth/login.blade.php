@extends('layout.auth')

@section('title', 'Login')
@section('form-action', route('form.login'))

@php
    $sections = [
        'email'=> 'email',
        'password' => 'password',
    ]
@endphp

@section('form-content')
    @foreach ($sections as $name => $type)
        <div class="mb-3">
            <label for="name" class="form-label">{{ $name }}</label>
            <input type="{{ $type }}" 
                   name="{{ $name }}"
                   id="{{ $name }}"
                   placeholder="Enter {{ $name }}"
                   value="{{ old($name) }}"
                   class="form-control @error($name) is-invalid @enderror"
                   required>
            @error($name)
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endforeach
@endsection
