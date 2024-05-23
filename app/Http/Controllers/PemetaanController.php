<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Dinas;
use App\Models\Mitra;
use App\Models\Wilayah;
use Illuminate\Support\Facades\DB;

class PemetaanController extends Controller
{
    public function index()
    {
        if (!session("user")) {
            return redirect("/login");
        }
        $coord = ["lat" => request()->lat ? request()->lat : -8.1687722, "lng" => request()->lng ? request()->lng : 113.6912252];
        return view("peta.index", ["coord" => $coord]);
    }
    public function tambahDataWilayahView()
    {
        $coord = ["lat" => request()->lat ? request()->lat : -8.1687722, "lng" => request()->lng ? request()->lng : 113.6912252];
        $wilayah = request()["wilayah"];
        if ($wilayah && Wilayah::where("wilayah", $wilayah)->first()) {
            return redirect("/pemetaan");
        }
        return view("peta.tambah", ["wilayah" => $wilayah, "coord" => $coord]);
    }
    public function editDataWilayahView()
    {
        $coord = ["lat" => request()->lat ? request()->lat : -8.1687722, "lng" => request()->lng ? request()->lng : 113.6912252];
        $wilayah = request()["wilayah"];
        $dataWilayah = Wilayah::where(["wilayah" => $wilayah])->first();
        return view("peta.edit", ["wilayah" => $wilayah, "dataWilayah" => $dataWilayah, "coord" => $coord]);
    }
    public function getWilayah($wilayah)
    {
        $role = request()->role;
        $data = Wilayah::where("wilayah", $wilayah)->first();
        if ($role === "dealer" || $role === "mitra") {
            if ($role === "mitra") {
                $dealers = Dealer::whereRaw("upper(alamat_dealer) LIKE ?", ["%" . strtoupper($wilayah) . "%"])->get();
                $data["relatives"] = $dealers;
            }
            if ($role === "dealer") {
                if ($data && $data->rekomendasi_tanaman) {
                    $benihs = explode(',', $data->rekomendasi_tanaman);
                    $benihs = array_map(function ($benih) {
                        return '%' . strtoupper(trim($benih)) . '%';
                    }, $benihs);
                    $where = "";
                    foreach ($benihs as $benih) {
                        if ($where) {
                            $where .= " OR ";
                        } else {
                            $where .= " WHERE ";
                        }
                        $where .= "UPPER(SUBSTRING_INDEX(nama_produk, '\"',  1)) LIKE '" . $benih . "'";
                    }
                    $mitras = DB::select("SELECT DISTINCT mitras.id, nama_perusahaan FROM mitras JOIN benih b on mitras.credential_id = b.mitra_id" . $where);
                    $data["relatives"] = $mitras;
                }else{
                    $data["relatives"] = [];
                }
            }
        }
        return response()->json($data);
    }
    public function dashboard()
    {
        $dinas = Dinas::first();
        $wilayah = Wilayah::all();
        return view("peta.dashboard", ["dinas" => $dinas, "wilayah" => $wilayah]);
    }
    public function tambahDataPemetaan()
    {
        $coord = ["lat" => request()->lat ? request()->lat : -8.1687722, "lng" => request()->lng ? request()->lng : 113.6912252];
        request()->validate([
            "wilayah" => "required",
            "luas_lahan" => "required|regex:/^\d+(\,\d{1,2})?$/",
            "topografi" => "required|regex:/^([^0-9]*)$/",
            "tipe_tanah" => "required|regex:/^([^0-9]*)$/",
            "kondisi_iklim" => "required",
            "kesuburan_tanah" => "required|regex:/^([^0-9]*)$/",
            "drainase" => "required|regex:/^([^0-9]*)$/",
            "rekomendasi_tanaman" => "required|regex:/^([^0-9]*)$/",
            "foto_wilayah" => "required|image"
        ]);

        $data = request()->only(
            "wilayah",
            "luas_lahan",
            "topografi",
            "tipe_tanah",
            "kondisi_iklim",
            "kesuburan_tanah",
            "drainase",
            "rekomendasi_tanaman"
        );
        $fotoWilayah = request()->file('foto_wilayah')->store('foto_wilayah', "public");
        $data['foto_wilayah'] = $fotoWilayah;

        Wilayah::create($data);
        return redirect("/pemetaan?lat=" . $coord["lat"] . "&lng=" . $coord["lng"])->with("success", "Data berhasil ditambahkan");
    }
    public function editDataWilayah()
    {
        $coord = ["lat" => request()->lat ? request()->lat : -8.1687722, "lng" => request()->lng ? request()->lng : 113.6912252];
        request()->validate([
            "wilayah" => "required",
            "luas_lahan" => "required|regex:/^\d+(\,\d{1,2})?$/",
            "topografi" => "required|regex:/^([^0-9]*)$/",
            "tipe_tanah" => "required|regex:/^([^0-9]*)$/",
            "kondisi_iklim" => "required",
            "kesuburan_tanah" => "required|regex:/^([^0-9]*)$/",
            "drainase" => "required|regex:/^([^0-9]*)$/",
            "rekomendasi_tanaman" => "required|regex:/^([^0-9]*)$/",
            "foto_wilayah" => "image"
        ]);

        $data = request()->only(
            "wilayah",
            "luas_lahan",
            "topografi",
            "tipe_tanah",
            "kondisi_iklim",
            "kesuburan_tanah",
            "drainase",
            "rekomendasi_tanaman"
        );
        if (request()->file('foto_wilayah')) {
            $fotoWilayah = request()->file('foto_wilayah')->store('foto_wilayah', "public");
            $data['foto_wilayah'] = $fotoWilayah;
        }

        Wilayah::where("wilayah", request()->wilayah)->update($data);
        return redirect("/pemetaan?lat=" . $coord["lat"] . "&lng=" . $coord["lng"])->with("success", "Data berhasil diubah");
    }
}
