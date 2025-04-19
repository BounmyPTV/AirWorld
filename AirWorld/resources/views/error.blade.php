@extends('layout.template')

@section('title', 'Erreur {{ $code }}')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-danger">{{ $code }}</h1>
        <p class="fs-3">Une erreur est survenue.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Retour à l'accueil</a>
    </div>
</div>
@endsection