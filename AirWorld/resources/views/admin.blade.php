@extends('template')
@section('title', 'formulaire')
@section('content')

    <form action="{{route('Add_Airport')}}" method="post">
        Add airport <br>
        1.Name: <br> 
        <input type="text" name="name"> <br>
        2.Country: <br> 
        <input type="text" name="country"> <br>
        @csrf
    </form>

    <form action="{{route('Add_Airplane')}}" method="post">
        Add airplane <br>
        1.Model: <br>
        <input type="text" name="model"> <br>
        2.Number of seats: <br>
        <input type="number" name="seats"> <br>
        @csrf
    </form>

    <form action="{{route('Add_Flight')}}" method="post">
        Add flight <br>
        1.Departure date: <br>
        <input type="date" name="depature_date"> <br>
        2.Arrival date:
        <input type="date" name="arrival_date"> <br>
        3.Departure time: <br>
        <input type="time" name="departure_time"> <br>
        4.Arrival time: <br>
        <input type="time" name="arrival_time"> <br>
        {{-- 5.Destination:
        <input type="number" name="departure_airport_id"> <br>
        6.Arrival:
        <input type="number" name="arrival_airport_id"> <br> --}}
        @csrf

    </form>

    <form action="{{route('Add_Passenger')}}" method="post">
        Add passenger 
        1.First name: <br>
        <input type="text" name="firstname"> <br>
        2.Surname: <br>
        <input type="text" name="surname"> <br>
        3.Seat number:
        <input type="text" name="seatnumber"> <br>
        @csrf
        
    </form>

    <form action="{{route('Add_Admin')}}" method="post">
        Add admin
        1.Name: <br>
        <input type="text" name="name"> <br>
        2.Email: <br>
        <input type="email" name="email"> <br>
        3.Password: <br>
        <input type="password" name="password"> <br>
        @csrf
    </form>

    <form action="{{route('Add_User')}}" method="post">
        1.Username: <br>
        <input type="text" name="username"> <br>
        2.Email: <br>
        <input type="email" name="email"> <br>
        3.Password: <br>
        <input type="password" name="password"> <br>
        @csrf
    </form>

    <form action="{{route('Add_Reservation')}}" method="post">
        Add reservation
        1.Baggages weight: <br>
        <input type="number" name="baggages">kg <br>
        2.Price:
        <input type="number" name="price">€ <br>
        @csrf
    </form>

    {{-- Suprimmer --}}
{{-- 
    <form action="{{route('Delete_Airport')}}" method="post">
        Delete airport <br>
        1.Name: <br> 
        <input type="text" name="name"> <br>
        2.Country: <br> 
        <input type="text" name="country"> <br>
        @csrf
    
    </form>

    <form action="{{route('Delete_Airplane')}}" method="post">
        Add airplane <br>
        1.Model: <br>
        <input type="text" name="model"> <br>
        2.Number of seats: <br>
        <input type="number" name="seats"> <br>
        @csrf
    </form>

    <form action="{{route('Delete_Flight')}}" method="post">
        Add flight <br>
        1.Departure date: <br>
        <input type="date" name="depature_date"> <br>
        2.Arrival date:
        <input type="date" name="arrival_date"> <br>
        3.Departure time: <br>
        <input type="time" name="departure_time"> <br>
        4.Arrival time: <br>
        <input type="time" name="arrival_time"> <br>
        {{-- 5.Destination:
        <input type="number" name="departure_airport_id"> <br>
        6.Arrival:
        <input type="number" name="arrival_airport_id"> <br> --}}
        {{-- @csrf

    </form>

    <form action="{{route('Delete_Passenger')}}" method="post">
        Add passenger 
        1.First name: <br>
        <input type="text" name="firstname"> <br>
        2.Surname: <br>
        <input type="text" name="surname"> <br>
        3.Seat number:
        <input type="text" name="seatnumber"> <br>
        @csrf
        
    </form>

    <form action="{{route('Delete_Admin')}}" method="post">
        Add admin
        1.Name: <br>
        <input type="text" name="name"> <br>
        2.Email: <br>
        <input type="email" name="email"> <br>
        3.Password: <br>
        <input type="password" name="password"> <br>
        @csrf
    </form>

    <form action="{{route('Delete_User')}}" method="post">
        1.Username: <br>
        <input type="text" name="username"> <br>
        2.Email: <br>
        <input type="email" name="email"> <br>
        3.Password: <br>
        <input type="password" name="password"> <br>
        @csrf
    </form>

    <form action="{{route('Delete_Reservation')}}" method="post">
        Add reservation
        1.Baggages weight: <br>
        <input type="number" name="baggages">kg <br>
        2.Price:
        <input type="number" name="price">€ <br>
        @csrf
    </form> --}} 
@endsection