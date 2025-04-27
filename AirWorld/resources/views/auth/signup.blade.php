@extends('layout.auth')

@section('title', 'S\'inscrire')
@section('form-action', route('form.register'))

@php
    use \App\Http\Helpers\SectionHelper;

    $section_signup = new SectionHelper();
    $section_signup->add_section('email', 'email', 'email');
    $section_signup->add_section('mot de passe', 'password', 'password');
    $section_signup->add_section('mot de passe', 'password_confirmation', 'password');
    $sections = $section_signup->get();
@endphp

@section('form-content')
    <div class="row">
        <div class="col-6 mb-3">
            <label for="name">Entrez votre prénom</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Prénom" value="{{ old('name') }}"
                required>
        </div>
        <div class="col-6 mb-3">
            <label for="surname">Entrez votre nom</label>
            <input type="text" class="form-control" name="surname" id="surname" placeholder="Nom"
                value="{{ old('surname') }}" required>
        </div>
    </div>
    @foreach ($sections as $i => $section)
        <div class="mb-3">
            <label for="name" class="form-label">
                @if ($i < 2) Entrez votre @else Confirmez votre @endif {{ $section['id'] }}</label>
            <input type="{{ $section['right'] }}" name="{{ $section['left'] }}" id="{{ $section['left'] }}"
                placeholder="{{ strtolower($section['id']) }}" value="{{ old($section['left']) }}"
                class="form-control @error($section['left']) is-invalid @enderror" required>
            @error($section['left'])
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endforeach
@endsection

@section('autre-content')
    <div class="mt-4 text-center">
        <p class="text-muted mb-1">Tu as déjà un compte ?</p>
        <a href="{{ route('login') }}" class="btn btn-link text-body">Connecte-toi <i
                class="fas fa-chevron-right ms-1"></i></a>
    </div>
@endsection