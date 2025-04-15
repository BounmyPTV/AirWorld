@extends('layout.template')

@section('content')

<style>
    .d-none {
        display: none !important;
    }
</style>

{{-- Header --}}
<header class="bg-light border-bottom">
    <div class="container d-flex justify-content-between align-items-center py-2">
        <div class="fw-bold fs-5">AirWorld</div>
        <div>
            @auth
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                        Bonjour {{ Auth::user()->name }}!
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownProfile">
                        <li><a class="dropdown-item" href="{{ route('account') }}">Mon profil</a></li>
                        <li><a class="dropdown-item" href="#">Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="px-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link dropdown-item text-danger">Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownLogin" data-bs-toggle="dropdown" aria-expanded="false">
                        Se connecter
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLogin">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Se connecter</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">S'inscrire</a></li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</header>

<nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
    <div class="container">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link nav-toggle" href="#" data-target="accueilContent">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-toggle" href="#" data-target="buyContent">Acheter un billet</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-toggle" href="#" data-target="discoverContent">Découvrir</a>
            </li>
        </ul>
    </div>
</nav>

<div id="contentSections">
    <div id="accueilContent" class="content-section d-none">
        <div class="container-fluid py-3">
            <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
                <div class="bg-light border rounded-3 p-3">🛫 Accueil - Infos à gauche</div>
                <div class="bg-light border rounded-3 p-3">🌍 Carte d'accueil ou contenu principal</div>
            </div>
        </div>
    </div>

    <div id="buyContent" class="content-section d-none">
        <div class="container-fluid py-3">
            <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
                <div class="bg-light border rounded-3 p-3">💳 Acheter - Infos à gauche</div>
                <div class="bg-light border rounded-3 p-3">📅 Choix du vol ou réservation</div>
            </div>
        </div>
    </div>

    <div id="discoverContent" class="content-section d-none">
        <div class="container-fluid py-3">
            <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
                <div class="bg-light border rounded-3 p-3">🗺️ Découvrir - Infos à gauche</div>
                <div class="bg-light border rounded-3 p-3">🏝️ Destinations ou offres spéciales</div>
            </div>
        </div>
    </div>
</div>

{{-- Footer --}}
<footer class="bg-light text-center py-4 mt-auto border-top">
    <div class="container">
        <p class="mb-0">&copy; {{ date('Y') }} AirWorld. Aucun droits réservés.</p>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navLinks = document.querySelectorAll('.nav-toggle');
        const sections = document.querySelectorAll('.content-section');

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();

                const targetId = link.getAttribute('data-target');

                sections.forEach(section => {
                    section.classList.add('d-none');
                });

                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.classList.remove('d-none');
                }
            });
        });
    });
</script>
@endsection