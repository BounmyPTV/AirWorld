@extends('layout.auth')

@section('title', 'Login')
@section('form-action', route('form.login'))

@php
    use \App\Http\Helpers\SectionHelper;

    $section_signup = new SectionHelper();
    $section_signup->add_section('Email', 'email', 'email');
    $section_signup->add_section('Mot de passe', 'password', 'password');
    $sections = $section_signup->get();
@endphp


@section('form-content')
    @foreach ($sections as $i => $section)
        <div class="mb-3">
            <label for="name" class="form-label">{{ $section['id'] }}</label>
            <input type="{{ $section['right'] }}" name="{{ $section['left'] }}" id="{{ $section['left'] }}"
                placeholder="Entrez votre {{ strtolower($section['id']) }}" value="{{ old($section['left']) }}"
                class="form-control @error($section['left']) is-invalid @enderror" required>
            @error($section['left'])
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endforeach
@endsection

@section('autre-content')
<div class="mt-4 text-center">
    <p class="text-muted mb-1">Tu n'as pas de compte ?</p>
    <a href="{{ route('register') }}" class="btn btn-link">inscris-toi! <i class="fas fa-chevron-right ms-1"></i></a>
</div>
@endsection