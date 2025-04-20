<?php

namespace App\Http\Controllers;

class SystemController extends Controller
{
    public function discover() { return view('discover'); }
    public function reservation() { return view('reservation'); }
    public function home() { return view('home'); }
}