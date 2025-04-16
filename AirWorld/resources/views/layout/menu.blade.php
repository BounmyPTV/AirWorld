@extends('layout.template')

{{-- section php --}}
@php
    use App\Http\Helpers\SectionHelper;
    use App\Http\Helpers\CardHelper;
    use App\Http\Helpers\ImgHelper;

    $res = route('reservation');
    $dis = route('discover');

    function card_navbar(int $pos, string $city, string $res) : array { 
        return CardHelper::card(ImgHelper::img_section($pos), "<h5>$city</h5>", $res);
    }

    $navbar_menu = new SectionHelper();
    $navbar_menu->add_section('accContent', '', [
        card_navbar(0, 'Paris', $res),
        card_navbar(1, 'Seattle', $res),
        card_navbar(6, 'Bangkok', $res),
        card_navbar(8, 'Vientiane', $res),
    ]);
    $navbar_menu->add_section('resContent', '', [
        card_navbar(7, '', '#'),
    ]);
    $navbar_menu->add_section('disContent', '', [
        card_navbar(2, 'Îles paradisiaques', $dis),
        card_navbar(3, 'Voyages en montagne', $dis),
        card_navbar(4, 'Villes à visiter', $dis),
    ]);

    $navbar_menu_section = $navbar_menu->get();

    $navbar_button = new SectionHelper();
    $navbar_button->add_section('Accueil', 'accContent', request()->routeIs('home'));
    $navbar_button->add_section('Réserver', 'resContent', request()->routeIs('reservation'));
    $navbar_button->add_section('Découvrir', 'disContent', request()->routeIs('discover'));

    $navbar_button_section = $navbar_button->get(); 
@endphp

{{-- section contenu --}}
@section('content')
{{-- partie style (css) --}}
<style>
        .nav-link.nav-toggle {
        transition: all 0.2s ease-in-out;
    }

    .nav-link.nav-toggle:hover {
        background-color: #f8f9fa;
    }

    .active-link {
        font-weight: bold;
        background-color: #e7f1ff;
        color: #0d6efd !important;
    }

    .visible-link-border {
        box-shadow: inset 0 -3px 0 #0d6efd;
    }

    .responsive-grid-layout {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 1rem;
        max-width: 1500;
    }

    .carousel-inner {
    position: relative;
}

    .carousel-inner::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 15%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.9) 100%); 
    }

    @media (max-width: 768px) {
        .responsive-grid-layout {
            display: flex !important;
            flex-direction: column;
        }
    }
</style>

{{-- Header --}}
<header class="bg-light border-bottom">
    <div class="container d-flex justify-content-between align-items-center py-2">
        <div class="fw-bold fs-5">AirWorld</div>
        {{-- 
        La partie authentification.
        Si la personne est connecté à son compte:
            - Profil
            - Panier
            - Les reservations
            - Les paramètres
            - une déconnexion
        Sinon:
            - Se connecter
            - S'inscrire
        --}}
        <div class="dropdown">
            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" 
            id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
            @auth <i class="fas fa-user-circle"></i> {{ Auth::user()->name }} @else<i class="fas fa-user"></i> Connexion @endauth
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownProfile">
                @auth
                <li><a href="{{ route('account') }}" class="dropdown-item">
                    <i class="fas fa-user"></i> Mon Profil</a></li>
                <li><a href="{{ route('cart') }}" class="dropdown-item">
                    <i class="fas fa-shopping-cart"></i> Mon Panier</a></li>
                <li><a href="{{ route('myreservation') }}" class="dropdown-item">
                    <i class="fas fa-ticket-alt"></i> Mes réservations</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a href="{{ route('settings') }}" class="dropdown-item">
                    <i class="fas fa-cog"></i> Paramètres</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-link dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt text-danger"></i> Déconnexion
                        </button>
                    </form>
                </li>
                @else
                <li><a class="dropdown-item" href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i> Se connecter</a></li>
                <li><a class="dropdown-item" href="{{ route('register') }}">
                    <i class="fas fa-user-plus"></i> S'inscrire</a></li>
                @endauth
            </ul>
        </div>
    </div>
</header>
{{-- Navbar (lié au Header) --}}
<nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
    <div class="container">
        <ul class="navbar-nav mx-auto">
            @foreach ($navbar_button_section as $index => $section)
            <li class="nav-item">
            <a class="nav-link nav-toggle px-3 py-2 {{ $section['right'] ? 'active-link' : '' }}" href="#" data-target="{{ $section['left'] }}">
                {{ $section['id'] }}
            </a>
            @endforeach
        </ul>
    </div>
</nav>
{{-- Contenu Navbar (les interactions des boutons de navbar) --}}
<div id="contentSections">
    @foreach ($navbar_menu_section as $index => $section)
    <div id="{{ $section['id'] }}" 
        class="content-section d-none container-fluid py-3 
        d-grid gap-3 responsive-grid-layout">
        <div class="border rounded-3 p-3 bg-light">{!! $section['left'] !!}</div>
        <div class="carousel slide" id="carouselRightContent{{ $index }}" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner rounded-2">
                @foreach($section['right'] as $i => $item)
                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }} text-center">
                        <a href="{{ $item['right'] }}">
                        @if (is_array($item))
                            @if ($item['id']) <img src="{{ asset($item['id']) }}" class="img-fluid"> @endif
                            <div class="carousel-caption d-none d-md-block" style="z-index: 1"> {!! $item['left'] !!}</div>
                        @else
                            <div>{{ $item }}</div>
                        @endif
                        </a>
                    </div>
                @endforeach
            </div>
            @if (count($section['right']) > 1)
            <div class="carousel-indicators">
                @foreach ($section['right'] as $i => $item)
                    <button type="button" data-bs-target="#carouselRightContent{{ $index }}" data-bs-slide-to="{{ $i }}"
                            class="{{ $i === 0 ? 'active' : '' }}"
                            aria-current="{{ $i === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $i + 1 }}"></button>
                @endforeach
            </div>
            @endif
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

{{-- partie script (js) --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navLinks = document.querySelectorAll('.nav-toggle');
        const sections = document.querySelectorAll('.content-section');
        let currentVisibleSection = null;
    
        const routes = {
            accContent: "{{ route('home') }}",
            resContent: "{{ route('reservation') }}",
            disContent: "{{ route('discover') }}"
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
    
                // Si on clique sur le bouton déjà ouvert : on ferme tout
                if (currentVisibleSection === targetSection) {
                    targetSection.classList.add('d-none');
                    link.classList.remove('visible-link-border');
                    currentVisibleSection = null;
                } else {
                    // Fermer tous les autres
                    sections.forEach(section => section.classList.add('d-none'));
                    navLinks.forEach(l => l.classList.remove('visible-link-border'));
    
                    // Ouvrir celui qu'on vient de cliquer
                    targetSection.classList.remove('d-none');
                    link.classList.add('visible-link-border');
                    currentVisibleSection = targetSection;
                }
    
                // Redirection si double clic
                if (timeSinceLastClick < 400) {
                    const destination = routes[targetId];
                    const currentUrl = window.location.href.split(/[?#]/)[0];
                    if (destination && currentUrl !== destination) {
                        window.location.href = destination;
                    }
                }
    
                lastClickTime = now;
            });
        });
    
        // Clique en dehors : tout se ferme
        document.addEventListener('click', (e) => {
            const isNavClick = e.target.closest('.nav-toggle');
            const isContentClick = e.target.closest('.content-section');
    
            if (!isNavClick && !isContentClick) {
                sections.forEach(section => section.classList.add('d-none'));
                navLinks.forEach(link => link.classList.remove('visible-link-border'));
                currentVisibleSection = null;
            }
        });
    });
    </script>
@endsection
