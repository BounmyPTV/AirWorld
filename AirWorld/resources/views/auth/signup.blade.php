@extends('layout.auth')

@section('title', 'S\'inscrire')
@section('form-action', route('form.register'))

@php
    use \App\Http\Helpers\SectionHelper;

    $section_signup = new SectionHelper();
    $section_signup->add_section('Nom', 'name', 'text');
    $section_signup->add_section('Prénom', 'surname', 'text');
    $section_signup->add_section('Email', 'email', 'email');
    $section_signup->add_section('Mot de passe', 'password', 'password');
    $section_signup->add_section('Confirmation de mot de passe', 'password_confirmation', 'password');
    $sections = $section_signup->get();
@endphp

@section('form-content')
    @foreach ($sections as $i => $section)
        <div class="mb-3">
            <label for="name" class="form-label">{{ $section['id'] }}</label>
            <input type="{{ $section['right'] }}" 
                   name="{{ $section['left'] }}"
                   id="{{ $section['left'] }}"
                   placeholder="Entrez votre {{ strtolower($section['id']) }}"
                   value="{{ old($section['left']) }}"
                   class="form-control @error($section['left']) is-invalid @enderror"
                   required>
            @error($section['left'])
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endforeach
@endsection
