@extends('layout.template')

@section('title', 'AirWorld -  Profil')

@section('content')
@auth
<div class="container mt-5">
    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body p-4">
            <h2 class="mb-4">👤 Profil de {{ Auth::user()->name }}</h2>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nom complet :</label>
                    <div class="form-control bg-light">{{ Auth::user()->name }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Adresse email :</label>
                    <div class="form-control bg-light">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('account.settings') }}" class="btn btn-outline-primary rounded-3">
                    ✏️ Modifier le profil
                </a>

                <form action="{{ route('account.logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-3">
                        🔓 Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection