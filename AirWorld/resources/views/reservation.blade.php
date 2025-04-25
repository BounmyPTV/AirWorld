@extends('layout.menu')

@section('content-menu')

<form class="form-inline" action="{{route('reservation')}}" method="get">
    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
      <option selected>Aller-Retour</option>
      <option value="2">Aller-Simple</option>
    </select><br>
    Destination:
    <select class="custom-select my-1 mr-sm-2" name="departure_id" id="inlineFormCustomSelectPref">
        @foreach($airports as $airport)
        <option selected value="{{$airport->id}}">{{$airport->country}}</option>
        @endforeach
      </select><br>
    Arrival:
      <select class="custom-select my-1 mr-sm-2" name="arrival_id" id="inlineFormCustomSelectPref">
        @foreach($airports as $airport)
        <option selected value="{{$airport->id}}">{{$airport->country}}</option>
        @endforeach
      </select><br>
    Date de départ:
      <input type="date" name="departure_date"> <br>
      Nombre de passager:
      <input type="number" name="number_of_passager"> <br>
      <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
        <option selected>Economie</option>
        <option value="2">Bussiness</option>
      </select><br>
    <button type="submit" class="btn btn-primary my-1">Recherche les vols</button>
  </form>

@endsection