<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\Program;

class HomeController extends Controller
{
    public function home()
    {
        $programs = Program::orderBy('created_at', 'desc')->get();
        $artikels = Artikel::orderBy('tanggal', 'desc')->get();
        if (session('user')) {
            return view("dashboard", ["programs" => $programs, "artikels" => $artikels]);
        }
        return view('welcome', ["programs" => $programs, "artikels" => $artikels]);
    }
}
