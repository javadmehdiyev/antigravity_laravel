<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get 6 latest cars for the homepage
        $featuredCars = Car::with('images')->latest()->take(6)->get();
        return view('home', compact('featuredCars'));
    }
}
