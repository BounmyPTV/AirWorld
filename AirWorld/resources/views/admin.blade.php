@extends('template')
@section('title', 'admin')
@section('content')



    @if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
            @endforeach
    @endif  
    
    <form  action="{{route('Add_Airport')}}" method="post">
        Add airport <br>
        1.Name:
        <input type="text" name="name"> <br>
        2.Country:  
        <input type="text" name="country"> <br>
        <input type="submit" name="send" value="Add">
        @csrf
    </form>
    <br>
    @if(session()->has('success_airport'))
        <p>{{session()->get('success_airport')}}</p>
    @endif
   
    
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
    @if(session()->has('success_airplane'))
    <p>{{session()->get('success_airplane')}}</p>
    @endif
    <form action="{{route('Add_Flight')}}" method="post">
        Add flight <br>
        1.Departure date: 
        <input type="date" name="departure_date"> <br>
        2.Arrival date: 
        <input type="date" name="arrival_date"> <br>
        3.Departure time:
        <input type="time" name="departure_time"> <br>
        4.Arrival time: 
        <input type="time" name="arrival_time"> <br>
        5.Departure airport id:
        <input type="number" name="departure_airport_id"> <br>
        6.Arrival airport id:
        <input type="number" name="arrival_airport_id"> <br>
        7.Airplane id:
        <input type="number" name="airplane_id"> <br>
        8.Price:
        <input type="number" name="price"> <br>
        <input type="submit" name="send" value="Add">
        @csrf
        
    </form>
    @if(session()->has('success_flight'))
        <p>{{session()->get('success_flight')}}</p>
    @endif
    </div>
    <br>
    <form action="{{route('Add_User')}}" method="post">
       Add user <br>
       1.Name: 
       <input type="text" name="name"> <br>
       2.Surname:
       <input type="text" name="surname"> <br>
       3.Email: 
       <input type="email" name="email"> <br>
       4.Password: 
       <input type="password" name="password"> <br>
       <input type="submit" name="send" value="Add">
       @csrf
    </form>
    <br>
    @if(session()->has('success_user'))
        <p>{{session()->get('success_user')}}</p>
    @endif
    <form action="{{route('Add_Reservation')}}" method="post">
        Add reservation <br>
        1.User id:
        <input type="text" name="user_id"> <br>
        2.Flight id:
        <input type="text" name="flight_id"> <br>
        3.Baggages weight:
        <input type="number" name="baggages">kg <br>
        4.Price: 
        <input type="number" name="price">€ <br>
        <input type="submit" name="send" value="Add">
        @csrf
    </form>
    <br>
    @if(session()->has('success_reservation'))
        <p>{{session()->get('success_reservation')}}</p>
    @endif

    <form action="{{route('Add_Passenger')}}" method="post">
        Add passenger <br>
        1. First name:
        <input type="text" name="firstname"> <br>
        2. Surname:
        <input type="text" name="surname"> <br>
        3. Seat number:
        <input type="text" name="seat_number"> <br>
        4. Reservation id:
        <input type="number" name="reservation_id"> <br>
        5. Adult:
        <select name="adult">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select> <br>
        <input type="submit" name="send" value="Add">
        @csrf
    </form>
    
    <br>
    @if(session()->has('success_passenger'))
        <p>{{session()->get('success_passenger')}}</p>
    @endif


    {{-- Supprimer --}}

    <form  action="{{route('Delete_Airport')}}" method="post">
        Delete airport <br>
        1.Name:
        <input type="text" name="name"> <br>
        2.Country:  
        <input type="text" name="country"> <br>
        <input type="submit" name="delete" value="Delete">
        @csrf
    </form>
    <br>
    @if(session()->has('supprime_airport'))
        <p>{{session()->get('supprime_airport')}}</p>
    @endif
    <form action="{{route('Delete_Airplane')}}" method="post">
        Delete airplane <br>
        1.Model: 
        <input type="text" name="model"> <br>
        2.Number of seats:
        <input type="number" name="seats"> <br>
        <input type="submit" name="send" value="Delete">
        @csrf
    </form>
    <br>
    @if(session()->has('supprime_airplane'))
    <p>{{session()->get('supprime_airplane')}}</p>
    @endif
    <form action="{{route('Delete_Flight')}}" method="post">
        Delete flight <br>
        1.Departure date: 
        <input type="date" name="departure_date"> <br>
        2.Arrival date: 
        <input type="date" name="arrival_date"> <br>
        3.Departure time:
        <input type="time" name="departure_time"> <br>
        4.Arrival time: 
        <input type="time" name="arrival_time"> <br>
        5.Departure airport id:
        <input type="number" name="departure_airport_id"> <br>
        6.Arrival airport id:
        <input type="number" name="arrival_airport_id"> <br>
        7.Airplane id:
        <input type="number" name="airplane_id"> <br>
        8.Price:
        <input type="number" name="price"> <br>
        <input type="submit" name="send" value="Delete">
        @csrf
        
    </form>
    @if(session()->has('success_flight'))
        <p>{{session()->get('success_flight')}}</p>
    @endif
    </div>
    <br>
    <form action="{{route('Delete_User')}}" method="post">
        Delete user <br>
       1.Name: 
       <input type="text" name="name"> <br>
       2.Surname:
       <input type="text" name="surname"> <br>
       3.Email: 
       <input type="email" name="email"> <br>
       4.Password: 
       <input type="password" name="password"> <br>
       <input type="submit" name="send" value="Delete">
       @csrf
    </form>
    <br>
    @if(session()->has('success_user'))
        <p>{{session()->get('success_user')}}</p>
    @endif
    <form action="{{route('Delete_Reservation')}}" method="post">
        Delete reservation <br>
        1.User id:
        <input type="text" name="user_id"> <br>
        2.Flight id:
        <input type="text" name="flight_id"> <br>
        3.Baggages weight:
        <input type="number" name="baggages">kg <br>
        4.Price: 
        <input type="number" name="price">€ <br>
        <input type="submit" name="send" value="Delete">
        @csrf
    </form>
    <br>
    @if(session()->has('success_reservation'))
        <p>{{session()->get('success_reservation')}}</p>
    @endif

    <form action="{{route('Delete_Passenger')}}" method="post">
        Add passenger <br>
        1. First name:
        <input type="text" name="firstname"> <br>
        2. Surname:
        <input type="text" name="surname"> <br>
        3. Seat number:
        <input type="text" name="seat_number"> <br>
        4. Reservation id:
        <input type="number" name="reservation_id"> <br>
        5. Adult:
        <select name="adult">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select> <br>
        <input type="submit" name="send" value="Delete">
        @csrf
    </form>
<div class="container mt-5">
    <h1 class="mb-4">Liste des Aéroports</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Pays</th>
            </tr>
        </thead>
        <tbody>
            @foreach($airports as $airport)
                <tr>
                    <td>{{ $airport->id }}</td>
                    <td>{{ $airport->name }}</td>
                    <td>{{ $airport->country }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h1 class="mb-4">Liste des avions</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Pays</th>
            </tr>
        </thead>
        <tbody>
            @foreach($airplanes as $airplane)
                <tr>
                    <td>{{ $airplane->id }}</td>
                    <td>{{ $airplane->model }}</td>
                    <td>{{ $airplane->seats }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 

<div class="container mt-5">
    <h1 class="mb-4">Liste des vols</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>departure_date</th>
                <th>arrival_date</th>
                <th>departure_time</th>
                <th>arrival_time</th>
                <th>departure_airport_id</th>
                <th>arrival_airport_id</th>
                <th>airplane_id</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flights as $flight)
                <tr>
                    <td>{{ $flight->id }}</td>
                    <td>{{ $flight->departure_date }}</td>
                    <td>{{ $flight->arrival_date }}</td>
                    <td>{{ $flight->departure_time}}</td>
                    <td>{{ $flight->arrival_time}}</td>
                    <td>{{ $flight->departure_airport_id }}</td>
                    <td>{{ $flight->arrival_airport_id }}</td>
                    <td>{{ $flight->airplane_id }}</td>
                    <td>{{ $flight->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 
<div class="container mt-5">
    <h1 class="mb-4">Liste des utilisateurs</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Nom de famille</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="container mt-5">
    <h1 class="mb-4">Liste des réservations</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>User id</th>
                <th>Flight id</th>
                <th>Baggages</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id}}</td>
                    <td>{{ $reservation->user_id}}</td>
                    <td>{{ $reservation->flight_id}}</td>
                    <td>{{ $reservation->baggages}}</td>
                    <td>{{ $reservation->price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>    
<div class="container mt-5">
    <h1 class="mb-4">Liste des passagers</h1>

    <table border=1px class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Prénom</th>
                <th>Nom de famille</th>
                <th>Numéro de siège</th>
                <th>Réservation id</th>
                <th>Adulte/Enfant</th>
            </tr>
        </thead>
        <tbody>
            @foreach($passengers as $passenger)
                <tr>
                    <td>{{ $passenger->id }}</td>
                    <td>{{ $passenger->firstname }}</td>
                    <td>{{ $passenger->surname }}</td>
                    <td>{{ $passenger->seat_number }}</td>
                    <td>{{ $passenger->reservation_id }}</td>
                    <td>
                        @if($passenger->adult == 1)
                            Adulte
                        @else
                            Enfant
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


    