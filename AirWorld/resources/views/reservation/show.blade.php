@extends('layout.template')

@php use \Carbon\Carbon; @endphp

@section('content')
    
    {{-- <div class="card shadow rounded-4 p-4 bg-body">
        <h2 class="mb-4 text-center">Détails du Vol</h2>

        <div class="row mb-4">
            <div class="col-md-6 text-center">
                <h4 class="mb-1">{{ $flight->departureAirport->name }}</h4>
                <p class="text-muted">{{ $flight->departureAirport->city }}, {{ $flight->departureAirport->country }}</p>
            </div>
            <div class="col-md-6 text-center">
                <h4 class="mb-1">{{ $flight->arrivalAirport->name }}</h4>
                <p class="text-muted">{{ $flight->arrivalAirport->city }}, {{ $flight->arrivalAirport->country }}</p>
            </div>
        </div>

        <div class="text-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
            </svg>
        </div>

        <div class="row text-center mb-4">
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

        <div class="text-center">
            <h5>Modèle de l'avion : <span class="fw-bold">{{ $flight->airplane->model }}</span></h5>
            <h5 class="mt-3">Prix : <span class="fw-bold text-primary">€{{ $flight->price }}</span></h5>
        </div>

        <div class="mt-4">
            <form action="" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 text-center mb-4">
                        <h4>Choisir le nombre de passagers</h4>
                        <input type="number" name="number_of_passengers" id="number_of_passengers" onchange="showPassengerFields()" class="form-select w-auto mx-auto">
                    </div>

                    <div id="passenger_details" style="display: none;">
                        <h4 class="text-center">Informations des passagers</h4>
                        <div id="passenger_fields"></div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Réserver</button>
                </div>
            </form>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('reservation.homepage') }}" class="btn btn-outline-primary">Retour</a>
        </div>
    </div>
</div>

<script>
    function showPassengerFields() {
        const numberOfPassengers = document.getElementById("number_of_passengers").value;
        const passengerFieldsContainer = document.getElementById("passenger_details");
        const passengerFieldsDiv = document.getElementById("passenger_fields");
        
        passengerFieldsDiv.innerHTML = '';
        
        if (numberOfPassengers > 0) {
            passengerFieldsContainer.style.display = "block";
            for (let i = 1; i <= numberOfPassengers; i++) {
                const passengerField = `
                    <div class="mb-3">
                        <h5>Passager ${i}</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="first_name_${i}" class="form-label">Prénom</label>
                                <input type="text" class="form-control" name="passengers[${i}][first_name]" id="first_name_${i}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="last_name_${i}" class="form-label">Nom</label>
                                <input type="text" class="form-control" name="passengers[${i}][last_name]" id="last_name_${i}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="baggage_${i}" class="form-label">Nombre de bagages</label>
                                <input type="number" class="form-control" name="passengers[${i}][baggage]" id="baggage_${i}" min="0" required>
                            </div>
                        </div>
                    </div>`;
                passengerFieldsDiv.innerHTML += passengerField;
            }
        } else {
            passengerFieldsContainer.style.display = "none";
        }
    }
</script> --}}
@endsection