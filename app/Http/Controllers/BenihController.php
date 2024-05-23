<?php

namespace App\Http\Controllers;

use App\Models\Benih;

class BenihController extends Controller
{
    public function galeriView()
    {
        $benihs = Benih::where("mitra_id", session("user")["id"])->get();
        return view('benih.galeri', ["benihs" => $benihs]);
    }
    public function tambahView()
    {
        return view('benih.tambah');
    }
    public function editView($id)
    {
        $benih = Benih::where("id", $id)->first();
        return view('benih.ubah', ["benih" => $benih]);
    }
    public function detailView($id)
    {
        $benih = Benih::where("id", $id)->first();
        return view('benih.detail', ["benih" => $benih]);
    }

    public function tambah()
    {
        request()->validate([
            "foto_produk" => "required|image",
            "nama_produk" => "required",
            "nama_varietas" => "required|regex:/^([^0-9]*)$/",
            "deskripsi" => "required",
            "berat_produk" => "required",
            "nomor_sertifikasi" => "required|numeric",
            "masa_berlaku_produk" => "required",
            "informasi_musim_tanam" => "required"
        ]);

        $data = request()->only(
            "nama_produk",
            "nama_varietas",
            "deskripsi",
            "berat_produk",
            "nomor_sertifikasi",
            "masa_berlaku_produk",
            "informasi_musim_tanam"
        );
        $fotoProduk = request()->file('foto_produk')->store('foto_produk', "public");
        $data['foto_produk'] = $fotoProduk;
        $data['mitra_id'] = session("user")["id"];

        Benih::create($data);
        return redirect()->route("galeri")->with("success", "Data benih berhasil ditambahkan");
    }
    public function edit($id)
    {
        request()->validate([
            "foto_produk" => "image",
            "nama_produk" => "required",
            "nama_varietas" => "required|regex:/^([^0-9]*)$/",
            "deskripsi" => "required",
            "berat_produk" => "required",
            "nomor_sertifikasi" => "required|numeric",
            "masa_berlaku_produk" => "required",
            "informasi_musim_tanam" => "required"
        ]);

        $data = request()->only(
            "nama_produk",
            "nama_varietas",
            "deskripsi",
            "berat_produk",
            "nomor_sertifikasi",
            "masa_berlaku_produk",
            "informasi_musim_tanam"
        );
        if (request()->file('foto_produk')) {
            $fotoProduk = request()->file('foto_produk')->store('foto_produk', "public");
            $data['foto_produk'] = $fotoProduk;
        }

        Benih::where("id", $id)->update($data);
        return redirect()->route("galeri")->with("success", "Data benih berhasil diubah");
    }
}
