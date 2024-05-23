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
        <a href="javascript:history.back()" class="self-start"><img src="/images/accent/arrow.png" alt="arrow"
                class="rotate-180"></a>
        <section id="galeri" class="w-full">
            <h1 class="text-[50px] font-bold">Galeri Benih</h1>
            <p>Dengan fitur Galeri Benih, produk benih yang sesuai dengan preferensi mitra yang Anda minati dapat
                ditemukan.</p>
            @if (count($benihs) === 0)
                <p class="text-center pt-8">Tidak ada data benih yang tersedia</p>
            @else
                <div class="grid grid-cols-12 my-4 items-center">
                    <button onclick="prev()" class="flex justify-center items-center"><img
                            src="/images/accent/double_arrow.svg" alt="double arrow"></button>
                    <div id="carousel" class="col-span-10 flex-grow grid grid-cols-4 gap-4">
                        @foreach ($benihs as $benih)
                            <a href="/detail-benih/{{ $benih->id }}"
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
                                        {{ $benih->informasi_musim_tanam }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <button onclick="next()" class="flex justify-center items-center"><img
                            src="/images/accent/double_arrow.svg" alt="double arrow" class="rotate-180"></button>
                </div>
            @endif
            <div id="carousel-indicator" class="flex justify-center gap-10">
                @for ($i = 0; $i < count($benihs) / 4; $i++)
                    <div
                        class="w-4 h-4 rounded-full @if ($i === 0) bg-slate-500 @else bg-slate-400 @endif">
                    </div>
                @endfor
            </div>
        </section>
        <a href="/tambah-benih"
            class="bg-green-500 flex items-center gap-2 rounded-md px-8 py-2 font-normal text-lg text-white self-end">Tambah
            Data +</a>
    </main>
    <script>
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
