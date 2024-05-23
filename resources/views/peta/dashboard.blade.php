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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <style>
        .leaflet-container {
            background: none !important;
        }
    </style>
</head>

<body class="relative">
    @include('components/header')
    <main
        class="min-h-screen flex flex-col justify-center items-center z-0 bg-gradient-to-b from-white to-[#75EBA133] py-32">
        <div class="flex w-4/5 gap-4 justify-center items-center">
            <aside class="w-1/2 z-20">
                <h1 class="text-[#333333] text-[70px] font-black tracking-[-.25rem] leading-[70px]">
                    {{ $dinas ? $dinas['nama_dinas'] : 'Dinas Pertanian dan Ketahanan Pangan Provinsi Jawa Timur' }}
                </h1>
                <p class="text-[#0F0F0F] mt-8 mb-4">
                    {{ $dinas
                        ? $dinas['informasi_dinas']
                        : 'Dinas Pertanian dan Ketahanan Pangan Provinsi Jawa Timur Pusat Agribisnis Tanaman Pangan dan
                                                                                Hortikultura Terkemuka, Berdaya Saing dan Berkelanjutan.' }}
                </p>
                @if ($dinas)
                    <a href="/profile-dinas"
                        class="bg-green-500 text-white px-4 py-2 rounded-full font-semibold text-[20px]">Lihat Detail
                        Profil</a>
                @endif
            </aside>
            <aside class="w-1/2 flex flex-col items-center">
                <a href="/pemetaan" class="font-semibold text-[30px]">Pemetaan Lahan</a>
                <div id="map" class="w-full h-[27rem] z-0"></div>
            </aside>
        </div>
        <div class="w-4/5 px-4 py-2 rounded-xl flex flex-col gap-1 mt-10 bg-white">
            <h1 class="text-[25px] font-bold">Dataran Tinggi dan Dataran Rendah di Wilayah Jember</h1>
            <hr class="w-full">
            <table id="table-wilayah" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Wilayah</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($wilayah); $i++)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $wilayah[$i]['wilayah'] }}</td>
                            <td>Luas tanah: {{ $wilayah[$i]['luas_lahan'] }} m&sup2; | Topografi:
                                {{ $wilayah[$i]['topografi'] }} | Tipe tanah: {{ $wilayah[$i]['tipe_tanah'] }} |
                                Kondisi Iklim: {{ $wilayah[$i]['kondisi_iklim'] }} |
                                Kesuburan Tanah: {{ $wilayah[$i]['kesuburan_tanah'] }} |
                                Drainase: {{ $wilayah[$i]['drainase'] }} |
                                Rekomendasi Tanaman Hortikultura:
                                {{ $wilayah[$i]['rekomendasi_tanaman_hortikultura'] }}
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </main>
    <script>
        let table = new DataTable('#table-wilayah');
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
            window.location.href = `/pemetaan?kecamatan=${kecamatanActive}&lat=${e.latlng.lat}&lng=${e.latlng.lng}`;
        }

        map.on('click', onMapClick);
    </script>
</body>

</html>
