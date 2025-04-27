@extends('layout.menu')

@php
    use \Carbon\Carbon;
@endphp

@section('content-menu')
    <div class="container p-4">
        <form action="{{ route('reservation.homepage') }}" class="form" method="GET" id="book1">
            <div class="row bg-body">
                <div class="col-md-4 mb-3">
                    <label for="search-departure-input" class="form-label">Départ</label>
                    <input type="text" id="search-departure-input" placeholder="Sélectionnez le lieu de départ"
                        class="form-control" value="{{ old('airport_departure_id') }}">
                    <div id="suggestions-departure" class="list-group mt-2 position-absolute" style="z-index: 1000"></div>
                    <input type="hidden" id="airport-departure-id" name="airport_departure_id" value="{{ old('airport_departure_id') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="search-arrival-input" class="form-label">Arrivé</label>
                    <input type="text" id="search-arrival-input" placeholder="Sélectionnez le lieu d'arrivée"
                        class="form-control" value="{{ old('airport_arrival_id') }}">
                    <div id="suggestions-arrival" class="list-group mt-2 position-absolute" style="z-index: 1000"></div>
                    <input type="hidden" id="airport-arrival-id" name="airport_arrival_id" value="{{ old('airport_arrival_id') }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label for="departure-date" class="form-label">Date de départ</label>
                    <input type="date" id="departure-date" name="departure_date" class="form-control" value="{{ old('departure_date') }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label for="arrival-date" class="form-label">Date d'arrivée</label>
                    <input type="date" id="arrival-date" name="arrival_date" class="form-control" value="{{ old('arrival_date') }}">
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>
    </div>
    <div class="container bg-body-secondary rounded-3 p-3" style="overflow: auto; height: 50vh;">
        @foreach($flights as $flight)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    {{-- Infos vol --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-1">
                                {{ $flight->departureAirport->name }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                </svg>
                                {{ $flight->arrivalAirport->name }}
                            </h5>
                            <small class="text-muted">
                                {{ $flight->departureAirport->city }} - {{ $flight->arrivalAirport->city }} <br>
                                {{ Carbon::parse($flight->departure_date)->format('d M Y') }},
                                Départ à {{ Carbon::parse($flight->departure_time)->format('H:i') }}
                                — Arrivée : {{ Carbon::parse($flight->arrival_time)->format('H:i') }}
                            </small><br>
                            <small class="text-muted">Avion : {{ $flight->airplane->model }}</small>
                        </div>
                        <div class="text-end">
                            <span class="fw-bold fs-6">€{{ $flight->price}}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination justify-content-center pt-3">
        {{ $flights->links('pagination::bootstrap-5') }}
    </div>


    <script>
        function loadSuggestions(query, input, suggestions, idInput) {
            fetch(`/reservation/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestions.innerHTML = '';
                    if (data.length === 0) {
                        const noResultsDiv = document.createElement('div');
                        noResultsDiv.classList.add('list-group-item');
                        noResultsDiv.textContent = 'Aucune suggestion';
                        suggestions.appendChild(noResultsDiv);
                    } else {
                        data.forEach(airport => {
                            const div = document.createElement('div');
                            div.classList.add('list-group-item', 'list-group-item-action');
                            div.textContent = `(${airport.country} - ${airport.city}) ${airport.name}`;

                            div.setAttribute('data-id', airport.id);
                            div.setAttribute('data-name', airport.name);

                            div.addEventListener('click', function () {
                                input.value = airport.name;
                                idInput.value = airport.id;
                                suggestions.innerHTML = '';
                            });

                            suggestions.appendChild(div);
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                });
        }

        function setupAutocomplete(inputId, suggestionsId, idInput) {
            const input = document.getElementById(inputId);
            const suggestions = document.getElementById(suggestionsId);
            const id = document.getElementById(idInput);

            inputActionListener = (action) => {
                input.addEventListener(action, function () {
                    const query = this.value;
                    loadSuggestions(query, input, suggestions, id);
                });
            };

            inputActionListener('focus');
            inputActionListener('input');

            input.addEventListener('blur', function () {
                setTimeout(() => {
                    suggestions.innerHTML = '';
                }, 200);
            });

            input.addEventListener('keydown', function (e) {
                const items = suggestions.getElementsByClassName('list-group-item');
                let selectedItem = Array.from(items).find(item => item.classList.contains('bg-primary'));

                if (e.key === 'ArrowDown') {
                    if (selectedItem) {
                        selectedItem.classList.remove('bg-primary');
                        const nextItem = selectedItem.nextElementSibling || items[0];
                        nextItem.classList.add('bg-primary');
                    } else if (items.length > 0) {
                        items[0].classList.add('bg-primary');
                    }
                } else if (e.key === 'ArrowUp') {
                    if (selectedItem) {
                        selectedItem.classList.remove('bg-primary');
                        const prevItem = selectedItem.previousElementSibling || items[items.length - 1];
                        prevItem.classList.add('bg-primary');
                    } else if (items.length > 0) {
                        items[items.length - 1].classList.add('bg-primary');
                    }
                } else if (e.key === 'Enter' && selectedItem) {
                    const airportName = selectedItem.getAttribute('data-name');

                    input.value = airportName;
                    suggestions.innerHTML = '';
                    id.value = selectedItem.getAttribute('data-id');
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            setupAutocomplete('search-departure-input', 'suggestions-departure', 'airport-departure-id');
            setupAutocomplete('search-arrival-input', 'suggestions-arrival', 'airport-arrival-id');
        });
    </script>
@endsection