@extends('layout.template')

@section('title', 'name')

@section('content')
@auth
    Hi {{ Auth::User()->name }}

    <form action="{{ route('auth.logout') }}" method="post">
        @csrf
        @method("delete")
        <input type="submit" value="logout">
    </form>
@endauth
@endsection