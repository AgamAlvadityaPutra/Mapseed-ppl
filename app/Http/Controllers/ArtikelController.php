<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Services\CustomTime;

class ArtikelController extends Controller
{
    public function detail($id)
    {
        $artikel = Artikel::find($id);
        $artikel->tanggal = CustomTime::FormatDate($artikel->tanggal);
        return view('artikel.detail', compact('artikel'));
    }
    public function tambahView()
    {
        return view('artikel.tambah');
    }
    public function ubahView($id)
    {
        $artikel = Artikel::find($id);
        return view('artikel.ubah', compact('artikel'));
    }

    public function tambah()
    {
        request()->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'kata_kunci' => 'required',
            'kesimpulan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $foto = request()->file('foto')->store('foto_artikel', 'public');
        
        $newArtikel = Artikel::create([
            'judul' => request('judul'),
            'penulis' => request('penulis'),
            'isi' => request('isi'),
            'tanggal' => request('tanggal'),
            'kata_kunci' => request('kata_kunci'),
            'kesimpulan' => request('kesimpulan'),
            'foto' => $foto,
        ]);

        return redirect("/artikel/".$newArtikel->id)->with('success', 'Data Artikel Berhasil Ditambahkan');
    }
    public function ubah($id) {
        request()->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'kata_kunci' => 'required',
            'kesimpulan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $artikel = Artikel::find($id);

        $artikel->update([
            'judul' => request('judul'),
            'penulis' => request('penulis'),
            'isi' => request('isi'),
            'tanggal' => request('tanggal'),
            'kata_kunci' => request('kata_kunci'),
            'kesimpulan' => request('kesimpulan'),
        ]);

        if (request()->hasFile('foto')) {
            $foto = request()->file('foto')->store('foto_artikel', 'public');
            $artikel->update([
                'foto' => $foto,
            ]);
        }

        return redirect("/artikel/".$artikel->id)->with('success', 'Data Artikel Berhasil Diubah');
    }
}
