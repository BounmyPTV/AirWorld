@extends('auth.global')

@section('title', 'login')

@section('content')
<form action="{{ route('auth.createLogin') }}" method="POST">

    @csrf
    Name: <br>
    <input type="text" name="name" id=""> <br>
    Email <br>
    <input type="email" name="email" id=""> <br>
    Password <br>
    <input type="password" name="pword" id=""> <br>
    <input type="submit" value="send">
</form>
@endsection