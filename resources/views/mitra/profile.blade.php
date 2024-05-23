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
    <main class="mt-2 flex flex-col gap-4 px-4 pb-4 w-full">
        <a href="javascript:history.back()" class="self-start"><img src="/images/accent/arrow.png" alt="arrow"
                class="rotate-180"></a>
        <section class="w-full bg-white rounded-xl overflow-y-auto">
            <h1 class="p-4 pb-2 text-xl font-bold">Profil</h1>
            <hr>
            <section class="p-4 pt-2">
                <h2 class="font-semibold mt-1">Nama Pimpinan Perusahaan:</h2>
                <p>{{ $mitra->nama_pimpinan_perusahaan }}</p>
                <h2 class="font-semibold mt-1">Nama Perusahaan:</h2>
                <p>{{ $mitra->nama_perusahaan }}</p>
                <h2 class="font-semibold mt-1">Nomor Telepon Perusahaan:</h2>
                <p>{{ $mitra->telepon_perusahaan }}</p>
                <h2 class="font-semibold mt-1">Email Perusahaan:</h2>
                <p>{{ $mitra->email_perusahaan }}</p>
                <h2 class="font-semibold mt-1">Alamat Perusahaan:</h2>
                <p>{{ $mitra->alamat_perusahaan }}</p>
                <h2 class="font-semibold mt-1">Informasi Perusahaan:</h2>
                <p>{{ $mitra->informasi_perusahaan }}</p>
            </section>
        </section>
        <button id="galeri-show" onclick="openGaleri()"
            class="bg-green-500 flex items-center gap-2 rounded-md px-8 py-2 font-normal text-lg text-white self-center">Galeri
            Benih <img src="/images/accent/show.svg" alt="show"></button>
        <section id="galeri" class="w-full flex flex-col items-center hidden">
            <h1 class="text-[50px] font-bold">Galeri Benih</h1>
            <p>Dengan fitur Galeri Benih, produk benih yang sesuai dengan preferensi mitra yang Anda minati dapat
                ditemukan.</p>
            @if (count($benihs) === 0)
                <p class="text-center pt-8">Belum ada benih yang tersedia.</p>
            @else
                <div class="grid grid-cols-12 my-4 items-center">
                    <button onclick="prev()" class="flex justify-center items-center"><img
                            src="/images/accent/double_arrow.svg" alt="double arrow"></button>
                    <div id="carousel" class="col-span-10 flex-grow grid grid-cols-4 gap-4">
                        @foreach ($benihs as $benih)
                            <div
                                class="bg-[url('/storage/{{ $benih->foto_produk }}')] bg-cover flex flex-col justify-end pt-56 rounded-xl @if ($loop->index > 3) hidden @endif">
                                <div class="bg-white rounded-b-xl px-4 py-2">
                                    <h2 class="font-semibold">{{ $benih->nama_produk }}</h2>
                                    <p class="text-[10px]"><span class="font-semibold">Nama Varietas</span>:
                                        {{ $benih->nama_varietas }}</p>
                                    <p class="text-[10px]"><span class="font-semibold">Deskripsi</span>:
                                        {{ $benih->deskripsi }}</p>
                                    <p class="text-[10px]"><span class="font-semibold">Berat Produk</span>:
                                        {{ $benih->berat_produk }}</p>
                                    <p class="text-[10px]"><span class="font-semibold">Nomor Sertifikasi</span>:
                                        {{ $benih->nomor_sertifikasi }}</p>
                                    <p class="text-[10px]"><span class="font-semibold">Masa Berlaku Produk</span>:
                                        {{ $benih->masa_berlaku_produk }}</p>
                                    <p class="text-[10px]"><span class="font-semibold">Informasi Musim Tanam</span>:
                                        {{ $benih->informasi_musim_tanam }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button onclick="next()" class="flex justify-center items-center"><img
                            src="/images/accent/double_arrow.svg" alt="double arrow" class="rotate-180"></button>
                </div>
            @endif
            <div id="carousel-indicator" class="flex justify-center gap-10">
                @for ($i = 0; $i < 0 / 4; $i++)
                    <div
                        class="w-4 h-4 rounded-full @if ($i === 0) bg-slate-500 @else bg-slate-400 @endif">
                    </div>
                @endfor
            </div>
        </section>
    </main>
    <script>
        const galeriShow = document.getElementById('galeri-show');
        const galeri = document.getElementById('galeri');
        const openGaleri = () => {
            galeri.classList.remove('hidden');
            galeriShow.classList.add('hidden');
        }

        const carouselItems = document.querySelectorAll('#carousel > div');
        const carouselIndicatorItems = document.querySelectorAll('#carousel-indicator > div');
        var page = 0;
        const next = () => {
            if (page === parseInt(carouselItems.length / 4)) return;
            page++;
            carouselItems.forEach((item, index) => {
                if (item.classList.contains('hidden') && (index >= page * 4 && index < (page + 1) * 4)) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
            carouselIndicatorItems.forEach((item, index) => {
                if (index === page) {
                    item.classList.add('bg-slate-500');
                    item.classList.remove('bg-slate-400');
                } else {
                    item.classList.add('bg-slate-400');
                    item.classList.remove('bg-slate-500');
                }
            });
        }
        const prev = () => {
            if (page === 0) return;
            page--;
            carouselItems.forEach((item, index) => {
                if (item.classList.contains('hidden') && (index >= page * 4 && index < (page + 1) * 4)) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
            carouselIndicatorItems.forEach((item, index) => {
                if (index === page) {
                    item.classList.add('bg-slate-500');
                    item.classList.remove('bg-slate-400');
                } else {
                    item.classList.add('bg-slate-400');
                    item.classList.remove('bg-slate-500');
                }
            });
        }
    </script>
</body>
