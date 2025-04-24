@extends('layout.menu')

@section('content-menu')
<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
      <h1 class="display-3 fw-bold">Bienvenue chez AirWorld</h1>
      <h3 class="fw-normal text-muted mb-3">Explorez le monde avec confort et sécurité</h3>
      <div class="d-flex gap-3 justify-content-center lead fw-normal">
        <a class="icon-link" href="#">
          En savoir plus
          <svg class="bi" aria-hidden="true"><use xlink:href="#chevron-right"></use></svg>
        </a>
        <a class="icon-link" href="#">
          Réservez votre vol
          <svg class="bi" aria-hidden="true"><use xlink:href="#chevron-right"></use></svg>
        </a>
      </div>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>

<div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="text-bg-dark flex-fill me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 py-3" id="home1">
        <h2 class="display-5">Des vols pour toutes les destinations</h2>
        <p class="lead">Nous vous connectons aux plus belles villes du monde.</p>
      </div>
      <div class="bg-body-tertiary shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
    <div class="bg-body-tertiary flex-fill me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden col-6">
      <div class="my-3 p-3">
        <h2 class="display-5">Voyagez confortablement</h2>
        <p class="lead">Profitez de nos services haut de gamme pour un voyage sans stress.</p>
      </div>
      <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
</div>
@endsection

