<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-control" content="private" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="/data/kecamatan_jember.js?v=1"></script>
    <style>
        .leaflet-container {
            background: none !important;
        }
    </style>
</head>

<body class="relative">
    <section id="artikel" class="min-h-screen flex flex-col px-8 py-12 bg-gradient-to-b from-white to-[#75EBA133]">
        <div class="w-full flex md:flex-row gap-2 flex-col items-stretch">
            <aside class="md:w-1/3">
                <h1 class="text-[50px] leading-[50px] font-bold md:text-left text-center">Artikel</h1>
                <img src="/images/illustration/illustration1.png" alt="illustration 1"
                    class="h-[80%] object-contain object-top md:block hidden" />
            </aside>
            <aside class="md:w-2/3 flex items-center gap-2 flex-grow">
                <section class="grid md:grid-cols-2 grid-rows-2 gap-4 h-full">
                    @foreach ($artikels as $artikel)
                        <a href="/artikel/{{ $artikel->id }}"
                            class="artikel-item flex flex-col items-start gap-3 p-6 border-4 rounded-xl">
                            <div class="bg-green-500 text-white py-2 px-3 rounded-md">
                                {{ $artikel->tanggal }}
                            </div>
                            <h2 class="text-[20px] font-semibold">
                                {{ $artikel->judul }}
                            </h2>
                            <p>
                                {{ $artikel->kata_kunci }}
                            </p>
                        </a>
                    @endforeach
                </section>
            </aside>
        </div>
        @if (session('user') && session('user')['role'] === 'dinas')
            <a href="/tambah-artikel"
                class="bg-green-500 flex items-center gap-2 rounded-md px-8 py-2 font-normal text-lg text-white self-start my-4">Tambah
                Data +</a>
        @endif
        <a href="/" id="toggleArtikel" class="text-slate-700 self-end underline font-bold mt-4">
            Tampilkan Lebih Sedikit
        </a>
    </section>
</body>
