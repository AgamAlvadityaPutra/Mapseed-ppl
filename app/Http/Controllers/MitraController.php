<?php

namespace App\Http\Controllers;

use App\Models\Benih;
use App\Models\Mitra;

class MitraController extends Controller
{
    public function listView()
    {
        $search = request('search');
        $kecamatan = request('kecamatan');
        $mitras = Mitra::whereRaw("UPPER(nama_perusahaan) LIKE ?", ['%' . strtoupper($search) . '%'])->whereRaw("UPPER(alamat_perusahaan) LIKE ?", ['%' . strtoupper($kecamatan) . '%'])->get();
        return view('mitra.list', ['mitras' => $mitras, 'search' => $search, 'kecamatan' => $kecamatan]);
    }
    public function profileView($id)
    {
        $mitra = Mitra::find($id);
        $benihs = Benih::where('mitra_id', $mitra->credential_id)->get();
        return view('mitra.profile', ['mitra' => $mitra, 'benihs' => $benihs]);
    }
    public function listMitra()
    {
        $search = request('search');
        $mitras = Mitra::select('id', 'nama_perusahaan')->whereRaw("UPPER(nama_perusahaan) LIKE ?", ['%'. strtoupper($search) . '%'])->get();
        return response()->json($mitras);
    }
}
