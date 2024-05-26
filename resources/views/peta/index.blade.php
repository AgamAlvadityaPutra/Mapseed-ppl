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
    <script src="https://unpkg.com/@mapbox/leaflet-pip@latest/leaflet-pip.js"></script>
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
                <h1 class="text-2xl">{{ session('success') }}</h1>
                <button onclick="document.querySelector('#modal').classList.add('hidden')"
                    class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
            </div>
        </div>
    @endif
    <main
        class="min-h-screen flex flex-col justify-center items-center z-0 bg-gradient-to-b from-white to-[#75EBA133] py-32">
        <div class="w-4/5"><a href="{{ session('user')['role'] === 'dinas' ? '/' : '/pemetaan-lahan' }}"><img
                    src="/images/accent/arrow.png" class="rotate-180" alt="back"></a></div>
        <div id="map" class="w-1/2 h-80 z-0"></div>
        <div class="w-4/5 mx-12 flex flex-col items-start bg-white p-8 rounded-xl gap-2">
            <h1 class="text-[25px] font-bold">Detail Wilayah</h1>
            <hr class="w-full">
            <label for="wilayah">Wilayah</label>
            <input type="text" id="wilayah" class="w-full p-2 border border-gray-300 rounded-md" disabled
                value="" />
            <label for="luas_lahan">Luas Lahan</label>
            <input type="text" id="luas_lahan" class="w-full p-2 border border-gray-300 rounded-md" disabled
                value="" />
            <label for="topografi">Topografi</label>
            <input type="text" id="topografi" class="w-full p-2 border border-gray-300 rounded-md" disabled
                value="" />
            <label for="tipe_tanah">Tipe Tanah</label>
            <input type="text" id="tipe_tanah" class="w-full p-2 border border-gray-300 rounded-md" disabled
                value="" />
            <label for="kondisi_iklim">Kondisi Iklim</label>
            <input type="text" id="kondisi_iklim" class="w-full p-2 border border-gray-300 rounded-md" disabled
                value="" />
            <label for="kesuburan_tanah">Kesuburan Tanah</label>
            <input type="text" id="kesuburan_tanah" class="w-full p-2 border border-gray-300 rounded-md" disabled
                value="" />
            <label for="drainase">Drainase</label>
            <input type="text" id="drainase" class="w-full p-2 border border-gray-300 rounded-md" disabled
                value="" />
            <label for="foto_wilayah">Foto Wilayah</label>
            <div class="relative w-full h-80">
                <input type="file" name="foto_wilayah" id="foto_wilayah"
                    class="absolute top-0 left-0 py-2 px-3 border-2 rounded-md w-full h-full opacity-0"
                    placeholder="Foto Dealer" disabled />
                <img class="hidden w-full h-full object-cover" id="foto_wilayah_preview">
                <div class="w-full h-full flex flex-col gap-4 items-center justify-center border-4 border-dashed"
                    id="foto_wilayah_placeholder">
                    <img src="/images/icons/image.png">
                    Upload foto
                </div>
            </div>
            @if (session('user')['role'] === 'dinas')
                <div class="w-full flex gap-4 mt-4 justify-end">
                    <a id="tambah-data" href="/tambah-wilayah"
                        class="bg-slate-400 text-white px-8 py-2 rounded-md">Tambah
                        Data</a>
                    <a id="edit-data" href="/edit-wilayah" class="bg-slate-400 text-white px-8 py-2 rounded-md">Ubah
                        Data</a>
                </div>
            @endif
        </div>
        <section class="w-4/5 flex flex-col items-center mt-8">
            <h2 class="font-bold text-[30px] mb-4">Rekomendasi Tanaman Holtikultura</h2>
            <div id="rekomendasi-tanaman" class="grid grid-cols-3 gap-2 w-full">
            </div>
        </section>
        @if (session('user')['role'] === 'dealer' || session('user')['role'] === 'mitra')
            <section class="w-4/5 flex flex-col items-center mt-8">
                <h2 class="font-bold text-[30px] mb-4">List
                    {{ session('user')['role'] === 'mitra' ? 'Dealer' : 'Mitra' }}
                    Benih</h2>
                <div id="list-relation-person" class="grid grid-cols-3 gap-2 w-full">
                </div>
            </section>
        @endif
    </main>
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
        });
        kecamatan.addTo(map);

        var marker = L.marker([{{ $coord['lat'] }}, {{ $coord['lng'] }}]).addTo(map);
        kecamatanActive = leafletPip.pointInLayer([{{ $coord['lng'] }}, {{ $coord['lat'] }}], kecamatan)[0].feature
            .properties["KECAMATAN"];
        marker.bindPopup(kecamatanActive).openPopup();
        setData(kecamatanActive, {
            lat: {{ $coord['lat'] }},
            lng: {{ $coord['lng'] }}
        });

        function onMapClick(e) {
            // if (marker) {
            //     map.removeLayer(marker);
            // }
            // marker = L.marker(e.latlng).addTo(map);
            // marker.bindPopup(kecamatanActive).openPopup();
            // setData(kecamatanActive, e.latlng);
            window.location.href = `?kecamatan=${kecamatanActive}&lat=${e.latlng.lat}&lng=${e.latlng.lng}`;
        }

        map.on('click', onMapClick);

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function setData(wilayah, latlng) {
            document.getElementById('wilayah').value = wilayah;
            fetch(`/api/wilayah/${wilayah}?role={{ session('user')['role'] }}`, {
                    method: 'GET'
                }).then(response => response.json())
                .then(data => {
                    if (!data) {
                        document.getElementById('luas_lahan').value = "";
                        document.getElementById('topografi').value = "";
                        document.getElementById('tipe_tanah').value = "";
                        document.getElementById('kondisi_iklim').value = "";
                        document.getElementById('kesuburan_tanah').value = "";
                        document.getElementById('drainase').value = "";
                        document.querySelector("#rekomendasi-tanaman").innerHTML =
                            "<p class='text-center col-span-3'>Belum ada rekomendasi tanaman</p>";
                        @if (session('user')['role'] === 'dealer' || session('user')['role'] === 'mitra')
                            document.querySelector("#list-relation-person").innerHTML =
                                "<p class='text-center col-span-3'>Belum ada data</p>";
                        @endif
                        return;
                    }
                    document.getElementById('luas_lahan').value = data.luas_lahan || "";
                    document.getElementById('topografi').value = data.topografi || "";
                    document.getElementById('tipe_tanah').value = data.tipe_tanah || "";
                    document.getElementById('kondisi_iklim').value = data.kondisi_iklim || "";
                    document.getElementById('kesuburan_tanah').value = data.kesuburan_tanah || "";
                    document.getElementById('drainase').value = data.drainase || "";
                    // document.getElementById('rekomendasi_tanaman').value = data.rekomendasi_tanaman || "";
                    if (data.rekomendasi_tanaman) {
                        document.querySelector("#rekomendasi-tanaman").innerHTML = data.rekomendasi_tanaman.split(",")
                            .map(tanaman => {
                                return `<div class="border-2 border-yellow-400 px-4 py-4 rounded-xl">
                                <h3 class="font-semibold text-[20px]">${capitalizeFirstLetter(tanaman.trim())}</h3>
                            </div>`;
                            }).join("");
                    } else {
                        document.querySelector("#rekomendasi-tanaman").innerHTML =
                            "<p class='text-center col-span-3'>Belum ada rekomendasi tanaman</p>";
                    }

                    if (data.relatives) {
                        if (data.relatives.length === 0) {
                            document.querySelector("#list-relation-person").innerHTML =
                                "<p class='text-center col-span-3'>Belum ada {{ session('user')['role'] === 'mitra' ? 'Dealer' : 'Mitra' }}</p>";
                        } else {
                            document.querySelector("#list-relation-person").innerHTML = data.relatives.map(
                                relatives => {
                                    return `<a href="/{{ session('user')['role'] === 'mitra' ? 'dealer' : 'mitra' }}/${relatives.id}" class="px-4 py-2 flex flex-col items-center gap-2">
                                    <img src="/images/profile.png" alt="profile">
                                    <p>
                                        @if (session('user')['role'] === 'mitra')
                                        ${relatives.nama_dealer}
                                        @else
                                        ${relatives['nama_perusahaan']}
                                        @endif
                                    </p>
                                    </a>`;
                                }).join("");
                        }
                    }
                    @if (session('user')['role'] === 'dealer' || session('user')['role'] === 'mitra')
                        else {
                            document.querySelector("#list-relation-person").innerHTML =
                                "<p class='text-center col-span-3'>Belum ada data</p>";
                        }
                    @endif

                    document.getElementById('foto_wilayah_preview').src = data.foto_wilayah ?
                        `/storage/${data.foto_wilayah}` : "";
                    if (data.foto_wilayah) {
                        document.getElementById('foto_wilayah_placeholder').classList.add('hidden');
                        document.getElementById('foto_wilayah_preview').classList.remove('hidden');
                        @if (session('user')['role'] === 'dinas')
                            document.getElementById("tambah-data").setAttribute("href", "");
                            document.getElementById("tambah-data").classList.add("pointer-events-none");
                            document.getElementById("tambah-data").classList.add("bg-slate-400");
                            document.getElementById("tambah-data").classList.remove("bg-yellow-500");
                            document.getElementById("edit-data").setAttribute("href",
                                `/edit-wilayah?wilayah=${wilayah}&lat=${latlng.lat}&lng=${latlng.lng}`);
                            document.getElementById("edit-data").classList.remove("pointer-events-none");
                            document.getElementById("edit-data").classList.remove("bg-slate-400");
                            document.getElementById("edit-data").classList.add("bg-green-500");
                        @endif
                    } else {
                        document.getElementById('foto_wilayah_placeholder').classList.remove('hidden');
                        document.getElementById('foto_wilayah_preview').classList.add('hidden');
                        @if (session('user')['role'] === 'dinas')
                            document.getElementById("tambah-data").setAttribute("href",
                                `/tambah-wilayah?wilayah=${wilayah}&lat=${latlng.lat}&lng=${latlng.lng}`);
                            document.getElementById("tambah-data").classList.remove("pointer-events-none");
                            document.getElementById("tambah-data").classList.remove("bg-slate-400");
                            document.getElementById("tambah-data").classList.add("bg-yellow-500");
                            document.getElementById("edit-data").setAttribute("href", "");
                            document.getElementById("edit-data").classList.add("pointer-events-none");
                            document.getElementById("edit-data").classList.add("bg-slate-400");
                            document.getElementById("edit-data").classList.remove("bg-green-500");
                        @endif
                    }
                });
        }
    </script>
</body>

</html>
