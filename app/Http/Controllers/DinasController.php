<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use App\Models\Dinas;
use Illuminate\Validation\Rules\Password;

class DinasController extends Controller
{
    public function profile()
    {
        $dinas = Dinas::first();
        if(!$dinas) {
            return redirect("/tambah-dinas");
        }
        return view("dinas.profile", ["dinas" => $dinas]);
    }
    public function akunDinasView()
    {
        if (!Dinas::first()) {
            return redirect("/tambah-dinas");
        }
        if (session('user') && session('user')["role"] === "admin") {
            $dinas = Dinas::first();
            return view('dinas.akun-dinas', ["dinas" => $dinas]);
        }
        return redirect("/");
    }
    public function tambahDinasView()
    {
        if (Dinas::first()) {
            return redirect("/akun-dinas");
        }
        if (session('user') && session('user')["role"] === "admin") {
            return view('dinas.tambah-dinas');
        }
        return redirect("/");
    }
    public function tambahDinas()
    {
        request()->validate([
            'username' => 'required|unique:credentials',
            'password' => ['required', 'alpha_num', Password::min(2)->letters()->numbers()],
            'nama_dinas' => 'required',
            'alamat_dinas' => 'required',
            'email_dinas' => 'required|email|unique:dinas',
            'telepon_dinas' => 'required|numeric',
            'informasi_dinas' => 'required',
            'foto_dinas' => 'required'
        ]);

        $fotoDinas = request()->file("foto_dinas")->store("foto-dinas", "public");
        $credentials = request()->only('username', 'password');
        $userData = request()->only(
            "nama_dinas",
            "alamat_dinas",
            "email_dinas",
            "telepon_dinas",
            "informasi_dinas"
        );

        $credentials['email'] = $userData["email_dinas"];
        $credentials['role'] = "dinas";
        $user = Credential::create($credentials);

        $userData["credential_id"] = $user->id;
        $userData["foto_dinas"] = $fotoDinas;
        Dinas::create($userData);

        return redirect("/akun-dinas")->with("success", "Akun Dinas Pertanian berhasil dibuat");
    }
}
