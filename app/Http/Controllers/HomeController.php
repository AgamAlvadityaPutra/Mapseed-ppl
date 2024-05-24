<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\Program;
use App\Services\CustomTime;

class HomeController extends Controller
{
    public function home()
    {
        $programs = Program::orderBy('created_at', 'desc')->get()->map(function ($program) {
            $program->waktu_pelaksanaan = CustomTime::FormatDate($program->waktu_pelaksanaan);
            return $program;
        });
        $artikels = Artikel::orderBy('tanggal', 'desc')->get()->map(function ($artikel) {
            $artikel->tanggal = CustomTime::FormatDate($artikel->tanggal);
            return $artikel;
        });
        if (session('user')) {
            return view("dashboard", ["programs" => $programs, "artikels" => $artikels]);
        }
        return view('welcome', ["programs" => $programs, "artikels" => $artikels]);
    }
}
