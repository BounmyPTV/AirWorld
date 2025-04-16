@extends('layout.template')

@section('content')

{{-- Sections --}}
@php
    $sections = [
        [
            'id' => 'accueilContent',
            'left' => '🛫 Infos générales',
            'right' => [
                ['images/0.png', '<h5>Paris</h5>', route('reservation')],
                ['images/1.png', '<h5>Seattle</h5>', '#'],
                ['images/6.png', '<h5>Bangkok</h5>', '#'],
                ['images/8.png', '<h5>Vientiane</h5>', '#']
            ],

        ],
        [
            'id' => 'buyContent',
            'left' => '💳 Réserver un billet',
            'right' => [
                ['images/7.png', '', '#'],
            ],
        ],
        [
            'id' => 'discoverContent',
            'left' => '🗺️ Explorer les destinations',
            'right' => [
                ['images/2.png', '<h5>Îles paradisiaques</h5>', '#'],
                ['images/3.png', '<h5>Voyages en montagne</h5>', '#'],
                ['images/4.png', '<h5>Villes à visiter</h5>', '#'],
            ],
        ]
    ];
@endphp

{{-- Style --}}
<style>
    .nav-link.nav-toggle {
        transition: all 0.2s ease-in-out;
    }

    .nav-link.nav-toggle:hover {
        background-color: #f8f9fa;
    }

    .active-link {
        font-weight: bold;
        border-bottom: 3px solid #0d6efd;
        background-color: #e7f1ff;
        color: #0d6efd !important;
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
                        <li><a class="dropdown-item" href="{{ route('cart') }}">Panier</a></li>
                        <li><a class="dropdown-item" href="{{ route('settings') }}">Paramètres</a></li>
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
                        <li><a class="dropdown-item" href="{{ route('cart') }}">Panier</a></li>
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
                <a class="nav-link nav-toggle px-3 py-2 {{ request()->routeIs('home') ? 'active-link' : '' }}" href="#" data-target="accueilContent">
                    Accueil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-toggle px-3 py-2 {{ request()->routeIs('reservation') ? 'active-link' : '' }}" href="#" data-target="buyContent">
                    Acheter un billet
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-toggle px-3 py-2 {{ request()->routeIs('discover') ? 'active-link' : '' }}" href="#" data-target="discoverContent">
                    Découvrir
                </a>
            </li>
        </ul>
    </div>
</nav>

<div id="contentSections">
    @foreach ($sections as $index => $section)
        <div id="{{ $section['id'] }}" class="content-section d-none">
            <div class="container-fluid py-3">
                <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
                    <div class=" border rounded-3 p-3 bg-light">{!! $section['left'] !!}</div>
                    <div class="carousel slide" id="carouselRightContent{{ $index }}" data-bs-ride="carousel" data-bs-interval="4000">
                        <div class="carousel-inner rounded-3">
                            @foreach ($section['right'] as $i => $item)
                                <div class="carousel-item {{ $i === 0 ? 'active' : '' }} text-center">
                                    <a href="{{ $item[2] }}">
                                        @if (is_array($item))
                                            @if ($item[0]) <img src="{{ asset($item[0]) }}" class="img-fluid" style="max-height: 400px;max-width: 1500px;"> @endif
                                            <div class="carousel-caption d-none d-md-block"> {!! $item[1] !!} </div>
                                        @else <div>{{ $item }}</div> @endif
                                    </a>
                                </div>
                            @endforeach  
                        </div>
                        @if (count($section['right']) > 1)
                            <div class="carousel-indicators">
                                @foreach ($section['right'] as $i => $item)
                                    <button type="button" data-bs-target="#carouselRightContent{{ $index }}" data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}" aria-current="{{ $i === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $i + 1 }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Footer --}}
<footer class="bg-light text-center py-4 mt-auto border-top">
    <div class="container">
        <p class="mb-0">&copy; {{ date('Y') }} AirWorld. Aucun droits réservés.</p>
    </div>
</footer>

{{-- Script --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navLinks = document.querySelectorAll('.nav-toggle');
        const sections = document.querySelectorAll('.content-section');
        let currentVisibleSection = null;

        // Map entre les IDs de sections et les routes Laravel (corrigé : 'accueilContent' vers 'home')
        const routes = {
            accueilContent: "{{ route('home') }}",
            buyContent: "{{ route('reservation') }}",
            discoverContent: "{{ route('discover') }}"
        };

        navLinks.forEach(link => {
            let lastClickTime = 0;

            link.addEventListener('click', (e) => {
                e.preventDefault();

                const targetId = link.getAttribute('data-target');
                const targetSection = document.getElementById(targetId);

                if (!targetSection) return;

                const now = new Date().getTime();
                const timeSinceLastClick = now - lastClickTime;

                // Affiche toujours la section au 1er clic
                if (currentVisibleSection === targetSection) {
                    targetSection.classList.add('d-none');
                    currentVisibleSection = null;
                } else {
                    sections.forEach(section => section.classList.add('d-none'));
                    targetSection.classList.remove('d-none');
                    currentVisibleSection = targetSection;
                }

                // Si deuxième clic dans les 400ms → redirection (sauf si on y est déjà)
                if (timeSinceLastClick < 400) {
                    const destination = routes[targetId];
                    const currentUrl = window.location.href.split(/[?#]/)[0]; // Sans query/hash
                    if (destination && currentUrl !== destination) {
                        window.location.href = destination;
                    }
                }

                lastClickTime = now;
            });
        });

        // Clic en dehors pour fermer les sections
        document.addEventListener('click', (e) => {
            const isNavClick = e.target.closest('.nav-toggle');
            const isContentClick = e.target.closest('.content-section');

            if (!isNavClick && !isContentClick) {
                sections.forEach(section => {
                    section.classList.add('d-none');
                    currentVisibleSection = null;
                });
            }
        });
    });
</script>
@endsection