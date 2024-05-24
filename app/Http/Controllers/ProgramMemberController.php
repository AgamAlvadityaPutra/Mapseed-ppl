<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Mitra;
use App\Models\Program;
use App\Models\ProgramMember;
// use Illuminate\Http\Request;

class ProgramMemberController extends Controller
{
    public function daftarView($id)
    {
        $program = Program::find($id);
        if ($program->kuota <= $program->members->count()) {
            // return redirect()->back()->with('invalid', ["message" => 'Kuota peserta untuk program agrikultur ini sudah penuh']);
            return redirect("/program/" . $program->id)->with('invalid', ["message" => 'Kuota peserta untuk program agrikultur ini sudah penuh']);
        }
        if (session('user')) {
            $akun = session('user')["role"] === "mitra" ? Mitra::where(["credential_id" => session('user')["id"]])->first() : Dealer::where(["credential_id" => session('user')["id"]])->first();
            return view('program.daftar', [
                'program' => $program,
                'akun' => $akun
            ]);
        }
        return view('program.daftar', [
            'program' => $program
        ]);
    }
    public function daftar($id)
    {
        request()->validate([
            'nama' => "required",
            'telepon' => "required|numeric",
            'email' => "required|email",
            'alamat' => "required",
            'pertanyaan' => "required",
        ]);

        ProgramMember::create([
            'program_id' => $id,
            'nama' => request('nama'),
            'telepon' => request('telepon'),
            'email' => request('email'),
            'alamat' => request('alamat'),
            'pertanyaan' => request('pertanyaan'),
        ]);

        return redirect()->route('home')->with('success', 'Pendaftaran Berhasil');
    }
}
