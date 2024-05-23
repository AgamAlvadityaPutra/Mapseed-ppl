@php
    $kecamatans = [
        'ajung',
        'ambulu',
        'arjasa',
        'balung',
        'bangsalsari',
        'gumukmas',
        'jelbuk',
        'jenggawah',
        'jombang',
        'kaliwates',
        'kencong',
        'ledokombo',
        'mayang',
        'mumbulsari',
        'pakusari',
        'panti',
        'patrang',
        'puger',
        'rambipuji',
        'sukowono',
        'semboro',
        'silo',
        'sukorambi',
        'sumberbaru',
        'sumberjambe',
        'sumbersari',
        'tanggul',
        'tempurejo',
        'umbulsari',
        'wirolegi',
        'wuluhan',
    ];
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgb(34 197 94);
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: rgb(34 197 94);
        }
    </style>
</head>

<body class="relative min-h-screen flex flex-col items-center px-6 bg-gradient-to-b from-white to-[#75EBA199]">
    <header class="flex justify-between items-center w-full py-6 z-50">
        <a href="/"><img src="/images/logo.png" alt="logo" class="h-[4rem]" /></a>
        @include('components/plainheader')
    </header>
    <main class="mt-2 flex flex-col gap-4 px-4 pb-4 w-full">
        <button onclick="javascript:history.back()" class="mb-2"><img src="/images/accent/arrow.png" alt="back"
                class="rotate-180"></button>
        <section class="bg-white rounded-xl h-[calc(100%-10rem)] overflow-y-auto">
            <h1 class="p-4 pb-2 text-xl font-bold">Profil</h1>
            <hr>
            <section class="p-4 pt-2">
                <h2 class="font-semibold mt-1">Nama Dealer:</h2>
                <p>{{ $dealer->nama_dealer }}</p>
                <h2 class="font-semibold mt-1">Nomor Telepon Dealer:</h2>
                <p>{{ $dealer->telepon_dealer }}</p>
                <h2 class="font-semibold mt-1">Email Dealer:</h2>
                <p>{{ $dealer->email_dealer }}</p>
                <h2 class="font-semibold mt-1">Alamat Dealer:</h2>
                <p>{{ $dealer->alamat_dealer }}</p>
                <h2 class="font-semibold mt-1">Informasi Dealer:</h2>
                <p>{{ $dealer->informasi_dealer }}</p>
                <h2 class="font-semibold mt-1">Riwayat Kerjasama:</h2>
                <p>{{ $dealer->riwayat_kerjasama }}</p>
                <h2 class="font-semibold mt-1">Pas Foto Dealer:</h2>
                <div class="bg-slate-500 border-4 border-dashed border-yellow-600 w-1/3 h-40">
                    <img class="w-full h-full object-cover" src="/storage/{{ $dealer->pas_foto_dealer }}"
                        alt="pas foto dealer">
                </div>
            </section>
        </section>
    </main>
</body>
