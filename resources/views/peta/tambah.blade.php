<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-control" content="private" />
    <title>MapSeed</title>
    <link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="/data/kecamatan_jember.js?v=1"></script>
</head>

<body class="relative">
    @include('components/header')
    @if ($errors->any())
        <div id="modal" class="w-screen h-screen bg-[#11111155] fixed top-0 z-50 flex items-center justify-center">
            <div
                class="w-1/3 bg-green-600 px-12 py-16 font-medium text-white rounded-xl drop-shadow-xl flex flex-col gap-2 items-center">
                <h1 class="text-2xl">
                    @php
                        $currError = '';
                    @endphp
                    @foreach ($errors->all() as $error)
                        @if (str_contains($error, 'required'))
                            @php
                                $currError = '';
                            @endphp
                            Harap isi semua data
                        @break
                    @endif
                    @php
                        $currError = $error;
                    @endphp
                @endforeach
                @if ($currError != '')
                    @if (str_contains($currError, 'username') && str_contains($currError, 'taken'))
                        Username sudah terdaftar! Gunakan Username berbeda dan pastikan format data benar
                    @elseif (str_contains($currError, 'email') && str_contains($currError, 'taken'))
                        Email sudah terdaftar! Gunakan Username berbeda dan pastikan format data benar
                    @else
                        Harap isi sesuai format data
                    @endif
                @endif
            </h1>
            <button onclick="document.querySelector('#modal').classList.add('hidden')"
                class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
        </div>
    </div>
@endif
<main
    class="min-h-screen flex flex-col justify-center items-center z-0 bg-gradient-to-b from-white to-[#75EBA133] py-32">
    <form action="/tambah-wilayah?wilayah={{ $wilayah }}&lat={{ $coord['lat'] }}&lng={{ $coord['lng'] }}"
        method="POST" class="w-4/5 mx-12 flex flex-col items-start bg-white p-8 rounded-xl gap-2"
        enctype="multipart/form-data">
        @csrf
        <h1 class="text-[25px] font-bold">Detail Wilayah</h1>
        <hr class="w-full">
        <label for="wilayah">Wilayah</label>
        <input type="text" id="wilayah" name="wilayah" class="w-full p-2 border border-gray-300 rounded-md"
            value="{{ $wilayah }}" disabled />
        <label for="luas_lahan">Luas Lahan</label>
        <div class="w-full">
            <input type="text" id="luas_lahan" name="luas_lahan"
                class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('luas_lahan') }}" />
            <p class="text-slate-400">*Format Luas Lahan wajib diisi angka</p>
        </div>
        <label for="topografi">Topografi</label>
        <input type="text" id="topografi" name="topografi" class="w-full p-2 border border-gray-300 rounded-md"
            value="{{ old('topografi') }}" />
        <label for="tipe_tanah">Tipe Tanah</label>
        <input type="text" id="tipe_tanah" name="tipe_tanah" class="w-full p-2 border border-gray-300 rounded-md"
            value="{{ old('tipe_tanah') }}" />
        <label for="kondisi_iklim">Kondisi Iklim</label>
        <input type="text" id="kondisi_iklim" name="kondisi_iklim"
            class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('kondisi_iklim') }}" />
        <label for="kesuburan_tanah">Kesuburan Tanah</label>
        <input type="text" id="kesuburan_tanah" name="kesuburan_tanah"
            class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('kesuburan_tanah') }}" />
        <label for="drainase">Drainase</label>
        <input type="text" id="drainase" name="drainase" class="w-full p-2 border border-gray-300 rounded-md"
            value="{{ old('drainase') }}" />
        <label for="rekomendasi_tanaman">Rekomendasi Tanaman Hortikultura</label>
        <div class="w-full">
            <input type="text" id="rekomendasi_tanaman" name="rekomendasi_tanaman"
                class="w-full p-2 border border-gray-300 rounded-md" value="{{ old('rekomendasi_tanaman') }}" />
            <p class="text-slate-400">*Jika terdapat lebih dari 1 rekomendasi tanaman, mohon pisahkan dengan tanda
                koma</p>
        </div>
        <div>
            <label for="foto_wilayah">Foto Wilayah</label>
            <p class="text-slate-400">*Tipe file yang diunggah harus berjenis Gambar : jpg, jpeg, png</p>
        </div>
        <div class="relative w-full h-80">
            <input type="file" name="foto_wilayah" id="foto_wilayah"
                class="absolute top-0 left-0 py-2 px-3 border-2 rounded-md w-full h-full opacity-0"
                accept=".jpg,.jpeg,.png" />
            <img class="hidden w-full h-full object-cover" id="foto_wilayah_preview" accept=".jpg,.jpeg,png">
            <div class="w-full h-full flex flex-col gap-4 items-center justify-center border-4 border-dashed"
                id="foto_wilayah_placeholder">
                <img src="/images/icons/image.png">
                Upload foto
            </div>
        </div>
        <div class="w-full flex gap-4 mt-4 justify-end">
            <button type="submit" id="tambah-data"
                class="bg-green-500 text-white px-8 py-2 rounded-md">Simpan</button>
            <a href="/pemetaan?lat={{ $coord['lat'] }}&lng={{ $coord['lng'] }}"
                class="bg-red-500 text-white px-8 py-2 rounded-md">Batal</a>
        </div>
    </form>
</main>
<script>
    document.querySelector("#foto_wilayah").addEventListener("change", function() {
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#foto_wilayah_preview").src = e.target.result;
            document.querySelector("#foto_wilayah_preview").classList.remove("hidden");
            document.querySelector("#foto_wilayah_placeholder").classList.add("hidden");
        }
        reader.readAsDataURL(file);
    });
</script>
</body>

</html>
