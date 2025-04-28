@extends('layout.template')

@php
    use Illuminate\Support\Facades\Schema;

    $admin = [
        "title" => [
            "affiche" => "Afficher une table",
            "add" => "Ajout d'une colonne",
            "update" => "Mise à jour d'une colonne",
            "delete" => "Suppression d'une colonne",
        ],
        "content" => [
            [
                "href" => "affiche",
                "pages" => [
                    "airport" => "",
                    "airplane" => "",
                    "flight" => "",
                    "reservation" => "",
                    "passenger" => "",
                    "user" => ""
                ],
            ],
            [
                "href" => "add",
                "pages" => [
                    'airport' => [Schema::getColumnListing('airports'), route('Add_Airport')],
                    'airplane' => [Schema::getColumnListing('airplanes'), route('Add_Airplane')],
                    'reservation' => [Schema::getColumnListing('reservations'), route('Add_Reservation')],
                    'flight' => [Schema::getColumnListing('flights'), route('Add_Flight')],
                    'passenger' => [Schema::getColumnListing('passengers'), route('Add_Passenger')],
                    'user' => [Schema::getColumnListing('users'), route('Add_User')],
                ]
            ],
            [
                "href" => "update",
                "pages" => [
                    'airport' => [Schema::getColumnListing('airports'), route('Update_Airport')],
                    'airplane' => [Schema::getColumnListing('airplanes'), route('Update_Airplane')],
                    'reservation' => [Schema::getColumnListing('reservations'), route('Update_Reservation')],
                    'flight' => [Schema::getColumnListing('flights'), route('Update_Flight')],
                    'passenger' => [Schema::getColumnListing('passengers'), route('Update_Passenger')],
                    'user' => [Schema::getColumnListing('users'), route('Update_User')],
                ],
            ],
            [
                "href" => "delete",
                "pages" => [
                    "airport" => ["", route('Delete_Airport')],
                    "airplane" => ["", route('Delete_Airplane')],
                    "flight" => ["", route('Delete_Flight')],
                    "reservation" => ["", route('Delete_Reservation')],
                    "passenger" => ["", route('Delete_Passenger')],
                    "user" => ["", route('Delete_User')]
                ],
            ],
        ],
    ];

    $ignore = [
        "affiche" => ['created_at', 'updated_at', 'email_verified_at', 'remember_token', 'password'],
        "add" => ['id', 'created_at', 'updated_at', 'email_verified_at', 'remember_token'],
        "update" => ['created_at', 'updated_at', 'email_verified_at', 'remember_token', 'role'],
        "delete" => [],
    ];

@endphp

@section('content')
<div class="container p-2">
    <div class="mt-4">
        <a href="{{ route('home') }}" class="text-body"><i
                class="fas fa-chevron-left ms-1"></i>Retournez à l'accueil</a>
    </div>
    <hr>
    <h1 class="h3">Page d'administration</h1>
    <div class="row g-2">

        {{-- Colonne 1 : Choix Action --}}
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Action</h5>
                </div>
                <div class="list-group list-group-flush" role="tablist">
                    @foreach(array_keys($admin['title']) as $i => $action)
                        <a class="list-group-item list-group-item-action {{ $i == 0 ? 'active' : '' }}"
                            data-bs-toggle="list" href="#tab-{{ $action }}" role="tab">
                            {{ $admin['title'][$action] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Colonne 2 : Choix Table --}}
        <div class="col-xl-6">
            <div class="tab-content">
                @foreach($admin['content'] as $i => $form_content)
                    <div class="tab-pane fade {{ $i == 0 ? 'show active' : '' }}" id="tab-{{ $form_content['href'] }}"
                        role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ $admin['title'][$form_content['href']] }}</h5>
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach($form_content['pages'] as $table => $info)
                                    <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                        href="#form-{{ $form_content['href'] }}-{{ $table }}" role="tab">
                                        {{ ucfirst($table) }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Colonne 3 : Formulaires --}}
        <div class="col-xl-12">
            <div class="tab-content">
                @foreach ($admin['content'] as $form_content)
                    @foreach ($form_content['pages'] as $table => $info)
                        <div class="tab-pane fade" id="form-{{ $form_content['href'] }}-{{ $table }}" role="tabpanel">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ ucfirst($table) }}</h5>
                                </div>
                                <div class="card-body p-0">
                                    @php $data = $list[$table] ?? []; @endphp
                                    @if ($form_content['href'] == 'affiche')
                                        @if (!empty($data))
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead class="table-dark">
                                                        <tr>
                                                            @if (count($data) > 0)
                                                                <thead class="table-dark w-100 h-100">
                                                                    <tr>
                                                                        @foreach ($data->first()->getAttributes() as $col => $value)
                                                                            @if (!in_array($col, $ignore['affiche']))
                                                                                <th>{{ ucfirst(str_replace('_', ' ', $col)) }}</th>
                                                                            @endif
                                                                        @endforeach
                                                                    </tr>
                                                                </thead>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $item)
                                                            <tr>
                                                                @foreach ($item->getAttributes() as $key => $value)
                                                                    @if (!in_array($key, $ignore['affiche']))
                                                                        <td>{{ $value }}</td>
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-center mt-2">
                                                    {{ $data->onEachSide(0)->links('pagination::bootstrap-5') }}
                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-warning">
                                                Aucun enregistrement trouvé pour cette table.
                                            </div>
                                        @endif
                                    @else
                                <form method="POST" action="{{ $info[1] }}" class="m-2">
                                    @csrf
                                    @if ($form_content['href'] != 'delete')
                                    @php $i = 1; @endphp
                                    @foreach ($info[0] as $item)
                                        @if (!in_array($item, $ignore[$form_content['href']]))
                                        @php
                                            $isId = ($item === 'id' || str_ends_with($item, '_id'));
                                            $type = 'text';
                                            
                                            if (str_contains($item, 'date')) $type = 'date';
                                            elseif (str_contains($item, 'time')) $type = 'time';
                                            elseif (str_contains($item, 'email')) $type = 'email';
                                            elseif (str_contains($item, 'password')) $type = 'password';
                                            elseif (str_contains($item, 'price') || str_contains($item, 'seat')) $type = 'number';
                                            elseif ($item == 'role' || $item == 'paid' || $item == 'adult') $type = 'radio';
                                        @endphp
                                        
                                        <div class="form-group mb-2">
                                            <label>{{ $i }}. {{ str_replace('_', ' ', $item) }}</label>
                                        
                                            @if ($isId)
                                                <input list="ids_{{ $table }}" name="{{ $item }}" class="form-control" placeholder="Choisir ou écrire un ID...">
                                                <datalist id="ids_{{ $table }}">
                                                    @foreach ($data as $element)
                                                        <option value="{{ $element->id }}">
                                                            {{ $element->name ?? $element->model ?? $element->id }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                                @elseif ($type == 'radio') 
                                                <div>
                                                    <label class="me-3">
                                                        <input type="radio" name="{{ $item }}" value="1" {{ old($item) == 1 ? 'checked' : '' }}> True
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="{{ $item }}" value="0" {{ old($item) == 0 ? 'checked' : '' }}> False
                                                    </label>
                                                </div>
                                            @else
                                                <input type="{{ $type }}" name="{{ $item }}" class="form-control">
                                            @endif
                                        </div>
                                        @php $i++; @endphp
                                    @endif
                                        @endforeach
                                        <button type="submit" class="btn btn-primary mt-3">
                                            {{ ucfirst($form_content['href']) }} {{ ucfirst($table) }}
                                        </button>
                                        @else
                                        @method('delete')
                                        <p class="text-danger">Entrez l'ID à supprimer :</p>
                                        <div class="form-group mb-2">
                                            <label>1. ID</label>
                                            <input list="ids_{{ $table }}" name="{{ $table }}_id" class="form-control" placeholder="Choisir ou écrire un ID...">
                                            <datalist id="ids_{{ $table }}">
                                                @foreach ($data as $element)
                                                @php
                                                    $data = ${$table . 's'} ?? [];
                                                @endphp
                                                    <option value="{{ $element->id }}">
                                                        {{ $element->name ?? $element->model ?? $element->id }}
                                                    </option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                        <button type="submit" class="btn btn-danger mt-3">Confirmer la suppression</button>                                       
                                        @endif
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    {{-- Succès --}}
    @if (session('success'))
        <div class="alert alert-success mt-3">
            <h5>Succès :</h5>
            <ul>
                <li>{{ session('success') }}</li>
            </ul>
        </div>
    @endif

    {{-- Erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <h5>Erreurs :</h5>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<script>
    document.querySelectorAll('[data-bs-toggle="list"]').forEach(link => {
        link.addEventListener('shown.bs.tab', function (e) {
            const firstColumn = this.closest('.col-xl-6');
            if (firstColumn && firstColumn.previousElementSibling === null) {
                const thirdColumn = document.querySelector('.col-xl-12');
                if (thirdColumn) {
                    thirdColumn.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.remove('show', 'active');
                    });
                }
            }
        });
    });
</script>