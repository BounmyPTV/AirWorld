@extends('layout.menu')

@php
  use App\Http\Helpers\ImgHelper;
  $val = 1;
  $featured = [
    "Vols à la une" => $home1, 
    "Meilleurs prix" =>  $home2, 
    "Départs imminent" => $home3
  ];
@endphp

@section('content-menu')
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
      <img src="{{ ImgHelper::img_section('icon') }}" alt="" class="h-100 w-100">
      <h3 class="fw-normal text-muted mb-3">Explorez le monde avec confort et sécurité</h3>
      <div class="d-flex gap-3 justify-content-center lead fw-normal">
        <a href="#home" class="btn btn-link text-body">En savoir plus <i class="fas fa-chevron-right ms-1"></i></a>
        <a href="{{ route('reservation') }}" class="btn btn-link text-body">Réserver un vol <i class="fas fa-chevron-right ms-1"></i></a>
      </div>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>
<div class="bg-body-tertiary py-5 p-1 p-md-5 m-md-3">
  <div class="container">
    <div class="row g-5">
      <div class="col-xl-6">
        <div class="d-flex flex-column justify-content-between bg-body p-5 rounded-4 h-100 shadow">
          <div class="text-center mb-3">
            <h2 class="display-5">Des vols pour toutes les destinations</h2>
            <p class="lead">Nous vous connectons aux plus belles villes du monde.</p>
          </div>
          <div class="rounded-2 overflow-hidden shadow w-100" style="height: 300px;">
            <img src="{{ ImgHelper::img_section(rand(0, 4)) }}" alt=""
                class="w-100 h-100 object-fit-cover">
          </div>
        </div>
      </div>
    
      <div class="col-xl-6">
        <div class="d-flex flex-column justify-content-between bg-body p-5 rounded-4 h-100 shadow">
          <div class="text-center mb-3">
            <h2 class="display-5">Voyagez confortablement</h2>
            <p class="lead">Profitez de nos services haut de gamme pour un voyage sans stress.</p>
          </div>
          <div class="rounded-2 overflow-hidden shadow w-100" style="height: 300px;">
            <img src="{{ ImgHelper::img_section(rand(5, 7)) }}" alt=""
                class="w-100 h-100 object-fit-cover">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="bg-body-tertiary py-5 p-1 p-md-5 m-md-3" id="home0">
  <h2 class="text-center mb-4">Nos offres du moment</h2>
  @foreach($featured as $name => $list)
  <div class="shadow bg-body rounded-4 m-1 p-4 m-4" id="home{{ $val }}">
    <h3 class="text-center mb-3" id="home1">{{ $name }}</h3>
    <div class="row row-cols-1 row-cols-md-3 g-3">
      @foreach($list as $f)
      <div class="col">
        <div class="card shadow-sm h-100">
          <a href="{{ route('reservation') }}/id/{{ $f->id }}" class="card-body rounded-3 bg-body-tertiary">
            <h5 class="card-title">{{ $f->departureAirport->name }} → {{ $f->arrivalAirport->name }}</h5>
            <p class="card-text">
              <strong>Départ :</strong> {{ $f->departure_date }} à {{ \Carbon\Carbon::parse($f->departure_time)->format('H:i') }}<br>
              <strong>Arrivée :</strong> {{ $f->arrival_date }} à {{ \Carbon\Carbon::parse($f->arrival_time)->format('H:i') }}
            </p>
            <p class="h5 fw-bold">{{ number_format($f->price, 2, ',', ' ') }} €</p>
          </a>
        </div>
      </div>
      @endforeach
      @php $val += 1; @endphp
    </div>
  </div>
  @endforeach
</div>
@endsection

