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
    <style>
        .leaflet-container {
            background: none !important;
        }
    </style>
</head>

<body class="relative">
    @include('components/header')
    @if (session('success'))
        <div id="modal" class="w-screen h-screen bg-[#11111155] fixed top-0 z-50 flex items-center justify-center">
            <div
                class="w-1/3 bg-white px-12 py-16 font-medium text-slate-600 rounded-xl drop-shadow-xl flex flex-col gap-2 items-center">
                <img class="w-20" src="/images/accent/success.svg" alt="success">
                <h1 class="text-2xl text-center">{{ session('success') }}</h1>
                <button onclick="document.querySelector('#modal').classList.add('hidden')"
                    class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
            </div>
        </div>
    @endif
    <main
        class="relative h-screen flex gap-4 items-center justify-center px-10 bg-gradient-to-b from-[#F2F4F5] to-[#75EBA199]">
        <aside class="w-1/3 z-20">
            <a href="/{{ 'pemetaan-lahan' }}"
                class="text-[#333333] text-[70px] font-black tracking-[-.25rem] leading-[70px]">
                Pemetaan Lahan
            </a>
            <p class="text-[#0F0F0F] mt-8">
                Fitur pemetaan lahan pada website MapSeed menyediakan gambaran yang komprehensif tentang kondisi
                geografis dan agronomis di wilayah Kabupaten Jember. Dengan fitur ini, pengguna dapat dengan mudah
                menavigasi peta interaktif yang menampilkan beragam informasi terkait lahan, seperti topografi, tipe
                tanah, kondisi iklim, dan rekomendasi tanaman hortikultura. Selain itu, pengguna juga dapat memperoleh
                informasi detail mengenai luas lahan, drainase, dan faktor-faktor lain yang memengaruhi produktivitas
                pertanian.
            </p>
        </aside>
        <div id="map" class="w-1/2 h-80 z-0"></div>
    </main>
    <section id="program-pemerintah"
        class="min-h-screen flex flex-col items-center px-8 py-12 bg-gradient-to-b from-white to-[#75EBA133]">
        <div>
            <h1 class="text-center text-[50px] leading-[50px] font-bold">
                Program<br />Pemerintah
            </h1>
            <img src="/images/accent/underline.svg" alt="underline" class="mt-2">
        </div>
        <p class="text-center my-4 w-[90%]">
            Program pemerintah dalam bidang pertanian bertujuan untuk meningkatkan
            produktivitas, kesejahteraan petani, dan ketahanan pangan negara. Dinas
            Pertanian sebagai salah satu badan yang terlibat dalam pelaksanaan
            program-program tersebut memiliki beragam kegiatan, antara lain:
        </p>
        @if (session('user')['role'] === 'dinas' && count($programs) <= 0)
            <a href="/tambah-program"
                class="bg-green-500 flex items-center gap-2 rounded-md px-8 py-2 font-normal text-lg text-white self-center mb-4">Tambah
                Data +</a>
        @endif
        <section class="grid grid-cols-4 gap-4 w-full flex-grow">
            @if (count($programs) > 0)
                @foreach ($programs as $program)
                    <a href="/program/{{ $program->id }}"
                        class="program-item border-4 rounded-md h-full {{ $loop->index >= 4 ? 'hidden' : '' }} {{ $loop->index === 0 ? 'border-slate-600' : '' }}">
                        <img class="object-cover w-full h-80" src="/storage/{{ $program->foto_program }}"
                            alt="foto program" />
                        <h2 class="p-2 pb-0 font-medium text-[#1F1F1F] text-[20px]">
                            {{ $program->nama }}
                        </h2>
                        <p class="p-2 pt-0">{{ $program->waktu_pelaksanaan }}</p>
                    </a>
                @endforeach
            @else
                <div class="col-span-4 flex items-center justify-center h-full">
                    <p>Belum ada program terdaftar</p>
                </div>
            @endif
        </section>
        <a href="/program" id="toggleProgram" class="text-slate-700 self-end underline font-bold mt-4">
            Lihat semua program
        </a>
    </section>
    <section id="artikel" class="min-h-screen flex flex-col px-8 py-12 bg-gradient-to-b from-white to-[#75EBA133]">
        <div class="w-full flex md:flex-row gap-2 flex-col items-stretch">
            <aside class="md:w-1/3">
                <div>
                    <h1 class="text-[50px] leading-[50px] font-bold md:text-left text-center">Artikel</h1>
                    <img src="/images/accent/underline.svg" alt="underline" class="mt-2">
                </div>
                <img src="/images/illustration/illustration1.png" alt="illustration 1"
                    class="h-[80%] object-cover md:block hidden" />
            </aside>
            <aside class="md:w-2/3 flex items-center gap-2 flex-grow">
                <button onclick="back()" id="backArtikelButton">
                    <img src="/images/icons/back.svg" alt="back" class="w-32" />
                </button>
                <section class="grid md:grid-cols-2 grid-rows-2 gap-4 h-full">
                    @foreach ($artikels as $artikel)
                        <a href="/artikel/{{ $artikel->id }}"
                            class="{{ $loop->index >= 4 ? 'hidden' : '' }} artikel-item flex flex-col items-start gap-3 p-6 border-4 {{ $loop->index === 0 ? 'border-slate-600' : '' }} rounded-xl">
                            <div class="bg-green-500 text-white py-2 px-3 rounded-md">
                                {{ $artikel->tanggal }}
                            </div>
                            <h2 class="text-[20px] font-semibold">
                                {{ $artikel->judul }}
                            </h2>
                            <p>
                                Kata Kunci: {{ $artikel->kata_kunci }}
                            </p>
                        </a>
                    @endforeach
                </section>
                <button onclick="next()" id="nextArtikelButton">
                    <img src="/images/icons/next.svg" alt="next" class="w-32" />
                </button>
            </aside>
        </div>
        @if (session('user') && session('user')['role'] === 'dinas' && count($artikels) <= 0)
            <a href="/tambah-artikel"
                class="bg-green-500 flex items-center gap-2 rounded-md px-8 py-2 font-normal text-lg text-white self-start my-4">Tambah
                Data +</a>
        @endif
        <a href="/artikel" id="toggleArtikel" class="text-slate-700 self-end underline font-bold mt-4">
            Lihat semua artikel
        </a>
    </section>
    <script>
        var artikelIndex = 1;

        function back() {
            const articles = document.querySelectorAll('.artikel-item');
            if (artikelIndex <= 1) {
                return;
            }
            artikelIndex--;
            for (let i = 0; i < articles.length; i++) {
                if (i >= (artikelIndex - 1) * 4 && i < artikelIndex * 4) {
                    articles[i].classList.remove('hidden');
                } else {
                    articles[i].classList.add('hidden');
                }
            }
        }

        function next() {
            const articles = document.querySelectorAll('.artikel-item');
            if (artikelIndex >= Math.ceil(articles.length / 4)) {
                return;
            }
            artikelIndex++;
            for (let i = 0; i < articles.length; i++) {
                if (i >= (artikelIndex - 1) * 4 && i < artikelIndex * 4) {
                    articles[i].classList.remove('hidden');
                } else {
                    articles[i].classList.add('hidden');
                }
            }
        }
    </script>
    <script>
        var map = L.map('map').setView([-8.1687722, 113.6912252], 10);

        var kecamatanActive;
        const kecamatan = L.geoJSON(kecamatanShape, {
            onEachFeature: function(feature, layer) {
                layer.on('click', function(e) {
                    kecamatanActive = feature.properties["KECAMATAN"];
                });
            },
            style: function(feature) {
                return {
                    color: '#000000',
                    weight: 1,
                    fillColor: '#00ff00',
                    fillOpacity: 0.5
                };
            }
        }).addTo(map);

        var marker;

        function onMapClick(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
            marker.bindPopup(kecamatanActive).openPopup();
        }

        map.on('click', onMapClick);
    </script>
</body>

</html>
