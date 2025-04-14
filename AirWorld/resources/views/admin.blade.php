@extends('template')
@section('title', 'admin')
@section('content')
    {{-- Ajouter des info sur des base de données --}}
<div>
    <form  action="{{route('Add_Airport')}}" method="post">
        Add airport <br>
        1.Name:
        <input type="text" name="name"> <br>
        2.Country:  
        <input type="text" name="country"> <br>
        <input type="submit" name="send" value="Add">
        @csrf
    </form>
</div>
    <br>
    <form action="{{route('Add_Airplane')}}" method="post">
        Add airplane <br>
        1.Model: 
        <input type="text" name="model"> <br>
        2.Number of seats:
        <input type="number" name="seats"> <br>
        <input type="submit" name="send" value="Add">
        @csrf
    </form>
    <br>
    <form action="{{route('Add_Flight')}}" method="post">
        Add flight <br>
        1.Departure date: 
        <input type="date" name="depature_date"> <br>
        2.Arrival date: 
        <input type="date" name="arrival_date"> <br>
        3.Departure time:
        <input type="time" name="departure_time"> <br>
        4.Arrival time: 
        <input type="time" name="arrival_time"> <br>
        5.Destination(airport):
        <input type="text" name="departure_airport_name"> <br>
        6.Destination(country):
        <input type="text" name="departure_airport_country"> <br>
        7.Arrival(airport):
        <input type="text" name="arrival_airport_name"> <br>
        8.Arrival(country):
        <input type="text" name="arrival_airport_country"> <br>
        9.Airplane model:
        <input type="text" name="airplane_model"> <br>
        10.Number of seats :
        <input type="number" name="airplane_seats"> <br>
        <input type="submit" name="send" value="Add">
        @csrf

    </form>
    <br>
    <form action="{{route('Add_Passenger')}}" method="post">
        Add passenger <br>
        1.First name: 
        <input type="text" name="firstname"> <br>
        2.Surname:
        <input type="text" name="surname"> <br>
        3.Seat number: 
        <input type="text" name="seatnumber"> <br>
        <input type="submit" name="send" value="Add">
        @csrf
    </form>
    <br>
    
    <br>
    <form action="{{route('Add_User')}}" method="post">
        Add user <br>
        1.Username: 
        <input type="text" name="username"> <br>
        2.Email: 
        <input type="email" name="email"> <br>
        3.Password: 
        <input type="password" name="password"> <br>
        <input type="submit" name="send" value="Add">
        @csrf
    </form>
    <br>
    <form action="{{route('Add_Reservation')}}" method="post">
        Add reservation <br>
        1.Baggages weight:
        <input type="number" name="baggages">kg <br>
        2.Price: 
        <input type="number" name="price">€ <br>
        <input type="submit" name="send" value="Add">
        @csrf
    </form>
    <br>

    {{-- Supprimer des infos sur des base de données --}}

    <form action="{{route('Delete_Airport')}}" method="post">
        Delete airport <br>
        1.Name: 
        <input type="text" name="name"> <br>
        2.Country: 
        <input type="text" name="country"> <br>
        <input type="submit" name="delete" value="Delete">
        @csrf
    </form>
    <br>
    <form action="{{route('Delete_Airplane')}}" method="post">
        Delete airplane <br>
        1.Model: 
        <input type="text" name="model"> <br>
        2.Number of seats: 
        <input type="number" name="seats"> <br>
        <input type="submit" name="delete" value="Delete">
        @csrf
    </form>
    <br>
    <form action="{{route('Delete_Flight')}}" method="post">
        Delete flight <br>
        1.Departure date: 
        <input type="date" name="depature_date"> <br>
        2.Arrival date:
        <input type="date" name="arrival_date"> <br>
        3.Departure time: 
        <input type="time" name="departure_time"> <br>
        4.Arrival time: 
        <input type="time" name="arrival_time"> <br>
        5.Destination:
        <input type="number" name="departure_airport_id"> <br>
        6.Arrival:
        <input type="number" name="arrival_airport_id"> <br>
        <input type="submit" name="delete" value="Delete">
        @csrf

    </form>
    <br>
    <form action="{{route('Delete_Passenger')}}" method="post">
        Delete passenger <br> 
        1.First name: 
        <input type="text" name="firstname"> <br>
        2.Surname: 
        <input type="text" name="surname"> <br>
        3.Seat number:
        <input type="text" name="seatnumber"> <br>
        <input type="submit" name="delete" value="Delete">
        @csrf
    </form>
    <br>
    <form action="{{route('Delete_User')}}" method="post">
        Delete user <br>
        1.Username: 
        <input type="text" name="username"> <br>
        2.Email: 
        <input type="email" name="email"> <br>
        3.Password: 
        <input type="password" name="password"> <br>
        <input type="submit" name="delete" value="Delete">
        @csrf
    </form>
    <br>
    <form action="{{route('Delete_Reservation')}}" method="post">
        Delete reservation <br>
        1.Baggages weight
        <input type="number" name="baggages">kg <br>
        2.Price:
        <input type="number" name="price">€ <br>
        <input type="submit" name="delete" value="Delete">
        @csrf
    </form> 
        
    {{-- Mise à jour les données --}}
    <form action="{{route('Update_Airport')}}" method="post">
        Update airport <br>
        1.Name: 
        <input type="text" name="name"> <br>
        2.Country: 
        <input type="text" name="country"> <br>
        <input type="submit" name="update" value="Update">
        @csrf
    </form>
    <br>
    <form action="{{route('Update_Airplane')}}" method="post">
        Update airplane <br>
        1.Model: 
        <input type="text" name="model"> <br>
        2.Number of seats: 
        <input type="number" name="seats"> <br>
        <input type="submit" name="update" value="Update">
        @csrf
    </form>
    <br>
    <form action="{{route('Delete_Flight')}}" method="post">
        Update flight <br>
        1.Departure date: 
        <input type="date" name="depature_date"> <br>
        2.Arrival date:
        <input type="date" name="arrival_date"> <br>
        3.Departure time: 
        <input type="time" name="departure_time"> <br>
        4.Arrival time: 
        <input type="time" name="arrival_time"> <br>
        5.Destination:
        <input type="number" name="departure_airport_id"> <br>
        6.Arrival:
        <input type="number" name="arrival_airport_id"> <br>
        <input type="submit" name="update" value="Update">
        @csrf

    </form>
    <br>
    <form action="{{route('Update_Passenger')}}" method="post">
        Update passenger <br> 
        1.First name: 
        <input type="text" name="firstname"> <br>
        2.Surname: 
        <input type="text" name="surname"> <br>
        3.Seat number:
        <input type="text" name="seatnumber"> <br>
        <input type="submit" name="update" value="Update">
        @csrf
    </form>
    <br>
    <form action="{{route('Update_User')}}" method="post">
        Update user <br>
        1.Username: 
        <input type="text" name="username"> <br>
        2.Email: 
        <input type="email" name="email"> <br>
        3.Password: 
        <input type="password" name="password"> <br>
        <input type="submit" name="update" value="Update">
        @csrf
    </form>
    <br>
    <form action="{{route('Update_Reservation')}}" method="post">
        Update reservation <br>
        1.Baggages weight
        <input type="number" name="baggages">kg <br>
        2.Price:
        <input type="number" name="price">€ <br>
        <input type="submit" name="update" value="Update">
        @csrf
    </form> 
@endsection