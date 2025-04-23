@extends('layout.template')

@section('content')
<div class="container p-2">
    <h1 class="h3 mb-3">Paramètres</h1>
    <div class="row">

        <div class="col-md-5 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Réglages du profil</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab">
                        <i class="fa fa-user me-2"></i>Compte
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#email" role="tab">
                        <i class="fa fa-envelope me-2"></i>Changer votre email
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab">
                        <i class="fa fa-lock me-2"></i>Changer votre mot de passe
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#delete" role="tab">
                        <i class="fa fa-trash me-2"></i>Supprimer votre compte
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-7 col-xl-8">
            <div class="tab-content">
                <!-- Section Compte -->
                <div class="tab-pane fade show active" id="account" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Informations publiques</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-4">
                                            <label class="text-muted fw-semibold mb-1" for="inputUsername">
                                                <i class="fa fa-user-circle me-2"></i>Nom d'utilisateur
                                            </label>
                                            <input type="text" class="form-control" id="inputUsername" 
                                                   value="{{ Auth::user()->name . ' ' . Auth::user()->surname }}" readonly>
                                        </div>
                                    
                                        <div class="form-group mb-4">
                                            <label class="text-muted fw-semibold mb-1" for="inputBio">
                                                <i class="fa fa-envelope me-2"></i>Email
                                            </label>
                                            <input type="email" class="form-control" id="inputBio" 
                                                   value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <img alt="Avatar" src="https://bootdey.com/img/Content/avatar/avatar{{ rand(1, 8) }}.png" class="rounded-circle img-responsive mt-2" width="128" height="128">
                                            <div class="mt-2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <!-- Section Email -->
                <div class="tab-pane fade" id="email" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Changer votre email</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('account.update') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="inputEmail">Nouvelle adresse email</label>
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Entrez votre nouveau email" name="email">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Mettre à jour l'email</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Section Password -->
                <div class="tab-pane fade" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Changer votre mot de passe</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('account.update') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="inputOldPassword">Ancien mot de passe</label>
                                    <input type="password" class="form-control" name="inputOldPassword" id="inputOldPassword" placeholder="Entrez votre ancien mot de passe">
                                </div>
                                <div class="form-group">
                                    <label for="inputNewPassword">Nouveau mot de passe</label>
                                    <input type="password" class="form-control" name="inputNewPassword" id="inputNewPassword" placeholder="Entrez votre nouveau mot de passe">
                                </div>
                                <div class="form-group">
                                    <label for="inputConfirmPassword">Confirmer le mot de passe</label>
                                    <input type="password" class="form-control" name="inputNewPassword_confirmation" id="inputConfirmPassword" placeholder="Confirmez le mot de passe">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Mettre à jour le mot de passe</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Section Delete Account -->
                <div class="tab-pane fade" id="delete" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Supprimer votre compte</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-danger">Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
                            <form method="POST" action="{{ route('account.delete') }}"> 
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer le compte</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection