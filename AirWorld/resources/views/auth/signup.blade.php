@extends('layout.auth')

@section('title', 'Register')
@section('form-action', route('form.register'))

@php
    $sections = [
        'name' => 'text',
        'email'=> 'email',
        'password' => 'password',
        'password_confirmation' => 'password' 
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
