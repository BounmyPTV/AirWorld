<!-- resources/views/admin/airports/index.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Liste des Aéroports</h1>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Liste des aéroports -->
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Pays</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($airports as $airport)
                    <tr>
                        <td>{{ $airport->id }}</td>
                        <td>{{ $airport->name }}</td>
                        <td>{{ $airport->country }}</td>
                        <td>
                            <a href="{{ route('admin.airports.edit', $airport->id) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route('admin.airports.delete', $airport->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bouton pour créer un nouvel aéroport -->
        <a href="{{ route('admin.airports.create') }}" class="btn btn-success">Créer un Aéroport</a>
    </div>
@endsection