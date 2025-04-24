@extends('layout.template')

{{-- section php --}}
@php
    use App\Http\Helpers\SectionHelper;
    use App\Http\Helpers\CardHelper;
    use App\Http\Helpers\ImgHelper;

    $home = route('home');
    $res = route('reservation');
    $dis = route('discover');

    function card_navbar(int $pos, string $city, string $res): array
    {
        return CardHelper::card(ImgHelper::img_section($pos), "<h5>$city</h5>", $res);
    }

    $navbar_menu = new SectionHelper();
    $navbar_menu->add_section(
        'accContent',
        [
            CardHelper::card('À la une', 'Découvrez nos destinations du moment.', "$home#home1"),
            CardHelper::card('Petits prix', 'Voyagez aux quatre coins du monde sans vous ruiner. Profitez de nos offres exceptionnelles!', "$home#home2"),
            CardHelper::card('Vite vite!', 'Les meilleures offres disparaissent rapidement. Saisissez qu\'il ne soit trop tard!', "$home#home3")
        ],
        [
            card_navbar(0, 'Paris', $res),
            card_navbar(1, 'Seattle', $res),
            card_navbar(6, 'Bangkok', $res),
            card_navbar(7, 'Vientiane', $res),
        ]
    );
    $navbar_menu->add_section(
        'resContent',
        [
            CardHelper::card('Réservez dès maintenant', 'Réservez votre voyage en toute simplicité. Prêt pour l\'aventure?', "$res#book1"),
            CardHelper::card('Offres exclusives', 'Des offres de réservation incroyables. Ne manquez pas nos promotions!', "$res#book2"),
            CardHelper::card('À la dernière minute', 'Réservez votre voyage à la dernière minute. C\'est encore possible!', "$res#book3")
        ],
        [
            card_navbar(8, 'N\'attendez plus!', '#'),
        ]
    );
    $navbar_menu->add_section(
        'disContent',
        [
            CardHelper::card('Destinations à découvrir', 'Partez à la découverte des endroits les plus incroyables!', "$dis#discover1"),
            CardHelper::card('Voyages immersifs', 'Vivez une expérience immersive. Explorez des lieux cachés et magnifiques!', "$dis#discover2"),
            CardHelper::card('Aventure sans fin', 'Découvrez des destinations exotiques. Pour les passionnés de découvertes!', "$dis#discover3")
        ],
        [
            card_navbar(2, 'Îles paradisiaques', $dis),
            card_navbar(3, 'Voyages en montagne', $dis),
            card_navbar(4, 'Villes à visiter', $dis),
        ]
    );

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
        .header-logo {
            height: 30px;
            width: auto;
            object-fit: contain;
        }

        .nav-link.nav-toggle {
            transition: all 0.2s ease-in-out;
        }

        .nav-link.nav-toggle:hover {
            background-color: var(--bs-body-bg);
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
            grid-template-columns: 0.8fr 2.2fr;
            gap: 1rem;
            max-width: 1500px;
            align-items: stretch;
            height: 100%;
        }

        .carousel-inner {
            position: relative;
            height: 100%;
        }

        .carousel-inner::after {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 20%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 20%, rgba(0, 0, 0, 0.9) 100%);
        }

        .carousel-image-wrapper {
            max-height: 500px;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .carousel-image-wrapper img {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        @media (max-width: 768px) {
            .responsive-grid-layout {
                grid-template-columns: 1fr;
            }
        }
    </style>

    {{-- Header --}}
    <div class="sticky-top" style="top: 0; z-index: 1020;">
        <header class="bg-body border-bottom">
            <div class="container d-flex justify-content-between align-items-center py-2">
                <img src="{{ ImgHelper::img_section('icon') }}" alt="AirWorld" class="header-logo">
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
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownProfile"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @auth <i class="fas fa-user-circle"></i> {{ Auth::user()->name . ' ' . Auth::user()->surname}}
                        @else<i class="fas fa-user"></i> Connexion @endauth
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownProfile">
                        @auth
                            <li><a href="{{ route('account.cart') }}" class="dropdown-item">
                                    <i class="fas fa-shopping-cart"></i> Mon Panier</a></li>
                            <li><a href="{{ route('account.myreservation') }}" class="dropdown-item">
                                    <i class="fas fa-ticket-alt"></i> Mes réservations</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="{{ route('account') }}" class="dropdown-item">
                                    <i class="fas fa-cog"></i> Paramètres</a></li>
                            <li>
                                <form action="{{ route('account.logout') }}" method="POST">
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
        <nav class="navbar navbar-expand bg-body-tertiary shadow-sm border-bottom">
            <div class="container">
                <ul class="navbar-nav mx-auto">
                    @foreach ($navbar_button_section as $index => $section)
                        <li class="nav-item">
                            <a class="nav-link nav-toggle px-3 py-2 
                                                {{ $section['right'] ? 'active text-primary fw-semibold' : 'text-body' }}"
                                href="#" data-target="{{ $section['left'] }}">
                                {{ $section['id'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
        {{-- Contenu Navbar (les interactions des boutons de navbar) --}}
        <div class=" position-relative">
            <div id="contentSections" class="bg-body-tertiary d-grid border-bottom shadow-sm rounded-bottom w-100"
                style="position: absolute; top: 0; left: 0; width: 100vw;">
                @foreach ($navbar_menu_section as $index => $section)
                    <div id="{{ $section['id'] }}" class="content-section d-none container-fluid py-3 
                                                                d-grid gap-3 responsive-grid-layout align-items-stretch">

                        {{-- Côté gauche --}}
                        <div class="list-group border rounded-3 p-1 bg-body-secondary h-100 shadow-sm">
                            @if (is_array($section['left']))
                                @foreach ($section['left'] as $i => $item)
                                    <a href="{{ $item['right'] }}"
                                        class="list-group-item list-group-item-action flex-column align-items-start h-100 group-button">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="mb-1">{{ $item['id'] }}</h5>
                                        </div>
                                        <small class="mb-5">{{ $item['left'] }}</small>
                                    </a>
                                @endforeach
                            @else
                                {!! $section['left']!!}
                            @endif
                        </div>

                        {{-- Côté droit --}}
                        <div class="carousel bg-body-secondary slide shadow h-100 d-none d-md-block rounded-2" id="carouselRightContent{{ $index }}"
                            data-bs-ride="carousel" data-bs-interval="3500">
                            <div class="carousel-inner rounded-2 h-100">
                                @foreach($section['right'] as $i => $item)
                                    <div class="carousel-item {{ $i === 0 ? 'active' : '' }} text-center h-100">
                                        <a href="{{ $item['right'] }}">
                                            @if ($item['id'])
                                                <div class="carousel-image-wrapper h-100">
                                                    <img src="{{ asset($item['id']) }}" loading="lazy"
                                                        class="img-fluid w-100 h-100 object-fit-cover" alt="Image">
                                                </div>
                                            @endif
                                            <div class="carousel-caption text-light" style="z-index: 1">
                                                {!! $item['left'] !!}
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            @if (count($section['right']) > 1)
                                <div class="carousel-indicators">
                                    @foreach ($section['right'] as $i => $item)
                                    <button class="bg-light {{ $i === 0 ? 'active' : '' }}" type="button" data-bs-target="#carouselRightContent{{ $index }}"
                                    data-bs-slide-to="{{ $i }}" aria-current="{{ $i === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $i + 1 }}"></button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Body --}}
    <main class="mb-2">
        @yield('content-menu')
    </main>

    {{-- Footer --}}
        <footer class="bg-body text-center py-4 mt-auto border-top">
            <div class="container">
                <div class="container">
                    <footer class="py-5">
                        <div class="row">
                            <div class="col-6 col-md-2 mb-3">
                                <h5>Nos Destinations</h5>
                                <ul class="nav flex-column">
                                    <li class="nav-item mb-2"><a href="#"
                                            class="nav-link p-0 text-body-secondary">Europe</a>
                                    </li>
                                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Asie</a>
                                    </li>
                                    <li class="nav-item mb-2"><a href="#"
                                            class="nav-link p-0 text-body-secondary">Amérique</a>
                                    </li>
                                    <li class="nav-item mb-2"><a href="#"
                                            class="nav-link p-0 text-body-secondary">Afrique</a>
                                    </li>
                                    <li class="nav-item mb-2"><a href="#"
                                            class="nav-link p-0 text-body-secondary">Océanie</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-6 col-md-2 mb-3">
                                <h5>Services</h5>
                                <ul class="nav flex-column">
                                    <li class="nav-item mb-2"><a href="#"
                                            class="nav-link p-0 text-body-secondary">Réservations</a></li>
                                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Billets
                                            d'avion</a></li>
                                    <li class="nav-item mb-2"><a href="#"
                                            class="nav-link p-0 text-body-secondary">Assurances</a></li>
                                    <li class="nav-item mb-2"><a href="#"
                                            class="nav-link p-0 text-body-secondary">Hôtels</a>
                                    </li>
                                    <li class="nav-item mb-2"><a href="#"
                                            class="nav-link p-0 text-body-secondary">Excursions</a></li>
                                </ul>
                            </div>

                            <div class="col-6 col-md-2 mb-3">
                                <h5>Aide</h5>
                                <ul class="nav flex-column">
                                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQ</a>
                                    </li>
                                    <li class="nav-item mb-2"><a href="#"
                                            class="nav-link p-0 text-body-secondary">Contactez-nous</a></li>
                                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Termes et
                                            conditions</a></li>
                                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Politique
                                            de
                                            confidentialité</a></li>
                                </ul>
                            </div>

                            <div class="col-md-5 offset-md-1 mb-3">
                                <form>
                                    <h5>Inscrivez-vous à notre newsletter</h5>
                                    <p>Recevez chaque mois des informations exclusives sur nos offres et destinations.</p>
                                    <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                                        <label for="newsletter1" class="visually-hidden">Adresse e-mail</label>
                                        <input id="newsletter1" type="email" class="form-control"
                                            placeholder="Adresse e-mail">
                                        <button class="btn btn-primary" type="button">S'abonner</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                            <p>&copy; {{ date('Y') }} AirWorld. Aucun droits réservés.</p>
                            <ul class="list-unstyled d-flex">
                                <li class="ms-3"><a class="link-body-emphasis" href="#" aria-label="Instagram"><svg
                                            class="bi" width="24" height="24">
                                            <use xlink:href="#instagram"></use>
                                        </svg></a></li>
                                <li class="ms-3"><a class="link-body-emphasis" href="#" aria-label="Facebook"><svg
                                            class="bi" width="24" height="24" aria-hidden="true">
                                            <use xlink:href="#facebook"></use>
                                        </svg></a></li>
                            </ul>
                        </div>
                    </footer>
                </div>
            </div>
    </footer>

    {{-- partie script (js) --}}
    <script>
 document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.nav-toggle');
    const sections = document.querySelectorAll('.content-section');
    const groupButtons = document.querySelectorAll('.group-button');

    let currentVisibleSection = null;
    let lastClickTimes = {};

    const routes = {
        accContent: "{{ route('home') }}",
        resContent: "{{ route('reservation') }}",
        disContent: "{{ route('discover') }}"
    };

    // Fonction pour cacher toutes les sections
    const hideAllSections = () => {
        sections.forEach(section => section.classList.add('d-none'));
        navLinks.forEach(link => link.classList.remove('visible-link-border'));
        currentVisibleSection = null;
    };

    // Gestion du clic sur les éléments du menu (navbar)
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('data-target');
            const targetSection = document.getElementById(targetId);
            const now = new Date().getTime();
            const timeSinceLastClick = now - (lastClickTimes[targetId] || 0);
            lastClickTimes[targetId] = now;

            if (!targetSection) return;

            if (currentVisibleSection === targetSection) {
                hideAllSections();
            } else {
                hideAllSections();
                targetSection.classList.remove('d-none');
                link.classList.add('visible-link-border');
                currentVisibleSection = targetSection;
            }

            if (timeSinceLastClick < 400) {
                const destination = routes[targetId];
                const currentUrl = window.location.href.split(/[?#]/)[0];
                if (destination && currentUrl !== destination) {
                    window.location.href = destination;
                }
            }
        });
    });

    // Fermer les sections si clic en dehors
    document.addEventListener('click', (e) => {
        const isNavClick = e.target.closest('.nav-toggle');
        const isContentClick = e.target.closest('.content-section');

        if (!isNavClick && !isContentClick) {
            hideAllSections();
        }
    });

    // Fermer les sections si clic sur un bouton à gauche
    groupButtons.forEach(button => {
        button.addEventListener('click', () => {
            hideAllSections();
        });
    });
});
    </script>
@endsection