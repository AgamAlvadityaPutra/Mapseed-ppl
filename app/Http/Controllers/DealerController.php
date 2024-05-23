<?php

namespace App\Http\Controllers;

use App\Models\Dealer;

class DealerController extends Controller
{
    public function listView()
    {
        if (!session('user')) return redirect()->route('login');
        $search = request('search');
        $kecamatan = request('kecamatan');
        $dealers = Dealer::whereRaw("UPPER(nama_dealer) LIKE ?", ['%' . strtoupper($search) . '%'])->whereRaw("UPPER(alamat_dealer) LIKE ?", ['%' . strtoupper($kecamatan) . '%'])->get();
        return view('dealer.list', ['dealers' => $dealers, 'search' => $search, 'kecamatan' => $kecamatan]);
    }
    public function profileView($id)
    {
        if (!session('user')) return redirect()->route('login');
        $kecamatan = request('kecamatan');
        $dealer = Dealer::find($id);
        return view('dealer.profile', ['dealer' => $dealer, 'kecamatan' => $kecamatan]);
    }
    public function listDealer()
    {
        $search = request('search');
        $dealers = Dealer::select('id', 'nama_dealer', 'alamat_dealer')->whereRaw("UPPER(nama_dealer) LIKE ?", ['%'. strtoupper($search) . '%'])->get();
        return response()->json($dealers);
    }
}
