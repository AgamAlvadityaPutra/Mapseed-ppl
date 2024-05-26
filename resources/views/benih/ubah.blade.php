<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MapSeed</title>
    <link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen flex flex-col items-center px-6 bg-gradient-to-b from-white to-[#75EBA199]">
    <header class="flex justify-between items-center w-full py-6 z-50">
        <a href="/"><img src="/images/logo.png" alt="logo" class="h-[4rem]" /></a>
        @include('components/plainheader')
    </header>
    @if ($errors->any())
        <div id="modal" class="w-screen h-screen bg-[#11111155] fixed top-0 z-50 flex items-center justify-center">
            <div
                class="w-1/3 bg-green-600 px-12 py-16 font-medium text-white rounded-xl drop-shadow-xl flex flex-col gap-2 items-center">
                <h1 class="text-2xl">
                    @if (session('invalid'))
                        {{ session('invalid')['message'] }}
                    @else
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
                @endif
            </h1>
            <button onclick="document.querySelector('#modal').classList.add('hidden')"
                class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
        </div>
    </div>
@endif
<main class="mt-2 flex flex-col gap-4 px-4 pb-4 w-full">
    <form action="/edit-benih/{{ $benih->id }}" method="POST" class="bg-white rounded-xl" enctype="multipart/form-data">
        @csrf
        <h1 class="p-4 pb-2 text-xl font-bold">Form Mengubah Data Benih</h1>
        <hr>
        <section class="p-4 pt-2 flex flex-col gap-1">
            <h2 class="font-semibold mt-1">Nama Produk</h2>
            <input name="nama_produk" type="text" class="px-2 py-1 border border-slate-500 rounded-sm w-full"
                value="{{ old('nama_produk') ? old('nama_produk') : $benih->nama_produk }}"
                placeholder="Benih Cabai Merah Keriting Hibrida 'Super Hot'">

            <h2 class="font-semibold mt-1">Nama Varietas</h2>
            <input name="nama_varietas" type="text" class="px-2 py-1 border border-slate-500 rounded-sm w-full"
                value="{{ old('nama_varietas') ? old('nama_varietas') : $benih->nama_varietas }}"
                placeholder="Super Hot">

            <h2 class="font-semibold mt-1">Deskripsi</h2>
            <textarea name="deskripsi" class="px-2 py-1 border border-slate-500 rounded-sm w-full resize-none" cols="30"
                rows="5"
                placeholder="Benih Cabai Merah Keriting Hibrida 'Super Hot' merupakan varietas unggul yang menghasilkan cabai merah keriting dengan rasa pedas yang luar biasa. Diformulasikan khusus untuk memberikan panen melimpah dan tahan terhadap hama penyakit.">{{ old('deskripsi') ? old('deskripsi') : $benih->deskripsi }}</textarea>

            <h2 class="font-semibold mt-1">Berat Produk</h2>
            <input name="berat_produk" type="text" class="px-2 py-1 border border-slate-500 rounded-sm w-full"
                value="{{ old('berat_produk') ? old('berat_produk') : $benih->berat_produk }}"
                placeholder="10 gram">

            <h2 class="font-semibold mt-1">Nomor Sertifikasi</h2>
            <input name="nomor_sertifikasi" type="text"
                value="{{ old('nomor_sertifikasi') ? old('nomor_sertifikasi') : $benih->nomor_sertifikasi }}"
                class="px-2 py-1 border border-slate-500 rounded-sm w-full" placeholder="1234567890">

            <h2 class="font-semibold mt-1">Masa Berlaku Produk</h2>
            <input name="masa_berlaku_produk" type="text"
                value="{{ old('masa_berlaku_produk') ? old('masa_berlaku_produk') : $benih->masa_berlaku_produk }}"
                class="px-2 py-1 border border-slate-500 rounded-sm w-full" placeholder="12 bulan">

            <h2 class="font-semibold mt-1">Informasi Musim Tanam</h2>
            <input name="informasi_musim_tanam" type="text"
                value="{{ old('informasi_musim_tanam') ? old('informasi_musim_tanam') : $benih->informasi_musim_tanam }}"
                class="px-2 py-1 border border-slate-500 rounded-sm w-full" placeholder="Musim Kemarau">

            <div class="grid grid-cols-2 gap-2">
                <label class="cursor-pointer relative">
                    <h2 class="font-semibold my-1">Foto</h2>
                    <input name="foto_produk" id="foto_produk" type="file"
                        class="w-0 h-0 opacity-0 absolute top-0 left-0" accept=".jpg,.jpeg,.png">
                    <div
                        class="w-full h-44 border-4 border-dashed p-2 flex flex-col items-center justify-center text-slate-400 gap-2">
                        <img src="/images/icons/image.png" alt="image" class="w-10 h-10">
                        Pilih Gambar
                    </div>
                </label>
                <div class="">
                    <h2 class="font-semibold my-1">Preview</h2>
                    <div class="hidden w-full h-44 border-4 border-yellow-400 border-dashed bg-slate-200"
                        id="foto_produk_placeholder"></div>
                    <img class="w-full h-44 object-cover border-4 border-dashed border-yellow-400"
                        id="foto_produk_preview" src="/storage/{{ $benih->foto_produk }}">
                </div>
            </div>
            <div class="flex gap-4 mt-4 self-end">
                <input type="submit" value="Simpan"
                    class="cursor-pointer bg-green-500 text-white px-8 py-2 rounded-md" />
                <a href="javascript:history.back()"
                    class="bg-red-500 text-white px-8 py-2 rounded-md">
                    Batal
                </a>
            </div>
        </section>
    </form>
</main>
<script>
    console.log("'{{ old('deskripsi_benih') }}'")
    document.querySelector("#foto_produk").addEventListener("change", function() {
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#foto_produk_preview").src = e.target.result;
            document.querySelector("#foto_produk_preview").classList.remove("hidden");
            document.querySelector("#foto_produk_placeholder").classList.add("hidden");
        }
        reader.readAsDataURL(file);
    });
</script>
</body>
