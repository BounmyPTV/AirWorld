@extends('layout.template')

@php use \Carbon\Carbon; @endphp

@section('content')
    <style>
        @media (min-width: 1200px) {
            #passengers_details {
                height: 26vh;
                overflow: auto;
            }
        }
    </style>
    <div class="container-fluid">
        <div class="bg-body shadow rounded-3 p-4 text-center m-3">
            <h2 class="mb-4 ">Détails du Vol</h2>
            <p class="mb-1 text-muted">{{ $flight->departureAirport->city }}, {{ $flight->departureAirport->country }}
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                </svg>
                {{ $flight->arrivalAirport->city }}, {{ $flight->arrivalAirport->country }}
            </p>
            <div class="bg-body-secondary rounded-3 p-3 text-center m-2 mt-3">
                <div class="row text-center pt-2">
                    <div class="col-md-6">
                        <h5>Départ</h5>
                        <p>{{ \Carbon\Carbon::parse($flight->departure_date)->format('d M Y') }}</p>
                        <p>Heure : {{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Arrivée</h5>
                        <p>{{ \Carbon\Carbon::parse($flight->arrival_date)->format('d M Y') }}</p>
                        <p>Heure : {{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</p>
                    </div>
                </div>
                <hr>
                <div class="row text-center mt-4">
                    <div class="col-md-6">
                        <h5>Modèle de l'avion</h5>
                        <p>{{ $flight->airplane->model }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Prix</h5>
                        <p id="total_price" class="fw-bold text-primary">{{ $flight->price }}€</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-body shadow rounded-3 py-2 text-center mx-3">
            <h2 class="mb-3 ">Réservation</h2>
            <form action="{{ route('reservation.affected', ["id"=> $flight->id]) }}" class="" id="res" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="row m-xl-5 bg-body-secondary p-2 shadow border rounded-2">
                    <div class="col-xl-6 text-center mb-4">
                        <h4>Passagers</h4>
                        <input type="number" name="number_of_passengers" id="number_of_passengers" class="form-select w-auto mx-auto" value="1">
                        <h4>Baggages</h4>
                        <input type="number" name="baggages" id="baggages" class="form-select w-auto mx-auto" required>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Réserver</button>
                        </div>
                    </div>

                    <div class="col-xl-6 bg-body border rounded p-2" id="passengers_details"></div>
                </div>
            </form>
        </div>

        <div class="position-fixed bottom-0 start-0 mb-3 me-3 p-2" style="width: 50px; height: 50px; z-index: 1080;">
            <a href="{{ route('reservation.homepage') }}" class="btn btn-primary w-100 h-100 d-flex justify-content-center align-items-center shadow p-0">
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>
    </div>

    <script>
        const number = document.getElementById('number_of_passengers');
        const field = document.getElementById('passengers_details');
        const totalPriceElement = document.getElementById('total_price');
        const flightPrice = {{ $flight->price }};

        function passengersFields() {
            console.log(number.value);
            field.innerHTML = '';
        
            const passengerField = (i, array) => { 
                return `
                <div class="mb-3 p-2 border rounded bg-body-tertiary">
                    <h5>Passager ${i}</h5>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="first_name_${i}" class="form-label">Prénom</label>
                            <input type="text" class="form-control" name="passengers[${i}][first_name]" id="first_name_${i}" ${array[0] ? 'value="' + array[0] + '"' : ''} required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="last_name_${i}" class="form-label">Nom</label>
                            <input type="text" class="form-control" name="passengers[${i}][last_name]" id="last_name_${i}" ${array[1] ? 'value="' + array[1] + '"' : ''} required>
                        </div>
                    </div>
                </div>`;
            };

            field.innerHTML += passengerField(1, ["{{auth()->user()->name}}", "{{ auth()->user()->surname }}"]);
            for (i = 2; i<=number.value; i++) { field.innerHTML += passengerField(i, []); }

            totalPriceElement.textContent = `${flightPrice * number.value}€`;
        }
        
        document.getElementById('res').addEventListener('keydown', function(event) {
            if (event.key === 'Enter') event.preventDefault();
        });

        number.addEventListener('change', passengersFields);
        number.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                passengersFields();
            }
        });

        passengersFields();
    </script>
@endsection