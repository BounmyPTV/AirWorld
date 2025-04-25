@extends('layout.template')
@section('title', 'AirWorld - Panier')

@php
    use \Carbon\Carbon;
    $item = 1;  
@endphp

@section('content')
    <div class="container-fluid h-100 p-4">
        <div class="rounded-1 card h-100 shadow bg-body-secondary">
            <div class="row h-100 g-0">
                <div id="scrollable-cart" class="scrollspy-example p-4" data-bs-spy="scroll" data-bs-target="#summary-nav"
                    data-bs-offset="0" tabindex="0">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Mes Reservations</h4>
                        <span class="text-muted">{{ count($res) }} révervations</span>
                    </div>

                    <div style="height:70vh; overflow-y: auto">
                        @foreach($res as $index => $r)
                            <div class="card mb-4 shadow-sm" id="reservation {{$item}}">
                                <div class="card-body">
                                    {{-- Infos vol --}}
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h5 class="mb-1">
                                                {{ $r->flight->departureAirport->name }}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                                </svg>
                                                {{ $r->flight->arrivalAirport->name }}
                                            </h5>
                                            <small class="text-muted">
                                                {{ Carbon::parse($r->flight->departure_date)->format('d M Y') }},
                                                Départ à {{ Carbon::parse($r->flight->departure_time)->format('H:i') }}
                                                — Arrivée : {{ Carbon::parse($r->flight->arrival_time)->format('H:i') }}
                                            </small><br>
                                            <small class="text-muted">Avion : {{ $r->flight->airplane->model }}</small>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-secondary">Réservation #{{ $item }}</span><br>
                                        </div>
                                    </div>

                                    {{-- Passagers --}}
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-2">Passagers</h6>
                                        <div class="row row-cols-1 row-cols-md-2 g-2">
                                            @foreach($r->passengers as $p)
                                                <div class="col">
                                                    <div class="border rounded p-3 d-flex align-items-center bg-body-secondary">
                                                        <div class="me-3">
                                                            <i class="bi bi-person-circle fs-3 text-secondary"></i>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="fw-semibold">{{ $p->firstname }} {{ $p->surname }}</div>
                                                            <div class="text-muted small">Siège : {{ $p->seat_number }}</div>
                                                            <div class="text-muted small">
                                                                {{ $p->adult ? 'Adulte' : 'Enfant' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="text-body"><i class="fas fa-chevron-left ms-1"></i>Retournez à
                            l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection