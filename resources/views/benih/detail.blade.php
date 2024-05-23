<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen flex flex-col items-center px-6 bg-gradient-to-b from-white to-[#75EBA199]">
    <header class="flex justify-between items-center w-full py-6 z-50">
        <a href="/"><img src="/images/logo.png" alt="logo" class="h-[4rem]" /></a>
        @include('components/plainheader')
    </header>
    @if (session('success'))
        <div id="modal" class="w-screen h-screen bg-[#11111155] fixed top-0 z-50 flex items-center justify-center">
            <div
                class="w-1/3 bg-white px-12 py-16 font-medium text-slate-600 rounded-xl drop-shadow-xl flex flex-col gap-2 items-center">
                <img class="w-20" src="/images/accent/success.svg" alt="success">
                <h1 class="text-2xl">{{ session('success') }}</h1>
                <button onclick="document.querySelector('#modal').classList.add('hidden')"
                    class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
            </div>
        </div>
    @endif
<main class="mt-2 flex flex-col gap-4 px-4 pb-4 w-full">
    <button onclick="javascript:history.back()" class="mb-2"><img src="/images/accent/arrow.png" alt="back" class="rotate-180"></button>
    <section class="bg-white rounded-xl">
        <h1 class="p-4 pb-2 text-xl font-bold">Detail Data Benih</h1>
        <hr>
        <section class="p-4 pt-2 flex flex-col gap-1">
            <h2 class="font-semibold mt-1">Nama Produk</h2>
            <input disabled name="nama_produk" type="text"
                class="px-2 py-1 border border-slate-500 rounded-sm w-full" value="{{ $benih->nama_produk }}"
                placeholder="Benih Cabai Merah Keriting Hibrida 'Super Hot'">

            <h2 class="font-semibold mt-1">Nama Varietas</h2>
            <input disabled name="nama_varietas" type="text"
                class="px-2 py-1 border border-slate-500 rounded-sm w-full" value="{{ $benih->nama_varietas }}"
                placeholder="Super Hot">

            <h2 class="font-semibold mt-1">Deskripsi</h2>
            <textarea disabled name="deskripsi" class="px-2 py-1 border border-slate-500 rounded-sm w-full resize-none"
                cols="30" rows="5"
                placeholder="Benih Cabai Merah Keriting Hibrida 'Super Hot' merupakan varietas unggul yang menghasilkan cabai merah keriting dengan rasa pedas yang luar biasa. Diformulasikan khusus untuk memberikan panen melimpah dan tahan terhadap hama penyakit.">{{ $benih->deskripsi }}</textarea>

            <h2 class="font-semibold mt-1">Berat Produk</h2>
            <input disabled name="berat_produk" type="text"
                class="px-2 py-1 border border-slate-500 rounded-sm w-full" value="{{ $benih->berat_produk }}"
                placeholder="10 gram">

            <h2 class="font-semibold mt-1">Nomor Sertifikasi</h2>
            <input disabled name="nomor_sertifikasi" type="text" value="{{ $benih->nomor_sertifikasi }}"
                class="px-2 py-1 border border-slate-500 rounded-sm w-full" placeholder="1234567890">

            <h2 class="font-semibold mt-1">Masa Berlaku Produk</h2>
            <input disabled name="masa_berlaku_produk" type="text" value="{{ $benih->masa_berlaku_produk }}"
                class="px-2 py-1 border border-slate-500 rounded-sm w-full" placeholder="12 bulan">

            <h2 class="font-semibold mt-1">Informasi Musim Tanam</h2>
            <input disabled name="informasi_musim_tanam" type="text" value="{{ $benih->informasi_musim_tanam }}"
                class="px-2 py-1 border border-slate-500 rounded-sm w-full" placeholder="Musim Kemarau">

            <div class="grid grid-cols-2 gap-2">
                <div class="">
                    <h2 class="font-semibold my-1">Preview</h2>
                    <img class="w-full h-44 object-cover border-4 border-dashed border-yellow-400"
                        id="foto_produk_preview" src="/storage/{{ $benih->foto_produk }}">
                </div>
            </div>
            <div class="flex gap-4 mt-4 self-end">
                <a href="/edit-benih/{{ $benih->id }}" class="bg-yellow-500 text-white px-8 py-2 rounded-md">
                    Ubah Data
                </a>
            </div>
        </section>
    </section>
</main>
</body>
