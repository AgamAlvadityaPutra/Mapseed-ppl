<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative">
    @include('components/header')
    <main
        class="relative h-screen flex items-center justify-center px-10 bg-gradient-to-b from-[#F2F4F5] to-[#75EBA199]">
        <aside class="w-1/2 z-20">
            <h1 class="text-[#333333] text-[70px] font-black tracking-[-.25rem] leading-[70px]">
                Dengan <span class="text-[#096A2E]">MapSeed</span> <br />
                Setiap Inci Tanah <br />
                Berharga
            </h1>
            <p class="text-[#0F0F0F] mt-8">
                Selamat datang di MapSeed, sahabat terpercaya dalam perjalanan
                pertanian Anda! Kami menawarkan solusi inovatif untuk memetakan tanah
                dan menentukan benih terbaik yang cocok untuk lahan Anda. Bersama
                kami, optimalkan potensi pertanian dengan kearifan dan teknologi
                terkini.
            </p>
        </aside>
        <img src="/images/mascot.png" class="img-fluid rounded-top h-3/4 z-20" alt="mascot" />
        <img src="/images/accent/curve.svg" alt="curve"
            class="absolute w-screen h-1/5 object-cover object-top bottom-0 z-10" />
    </main>
    <section id="program-pemerintah"
        class="min-h-screen flex flex-col items-center px-8 py-12 bg-gradient-to-b from-white to-[#75EBA133]">
        <h1 class="text-center text-[50px] leading-[50px] font-bold">
            Program<br />Pemerintah
        </h1>
        <p class="text-center my-4 w-[90%]">
            Program pemerintah dalam bidang pertanian bertujuan untuk meningkatkan
            produktivitas, kesejahteraan petani, dan ketahanan pangan negara. Dinas
            Pertanian sebagai salah satu badan yang terlibat dalam pelaksanaan
            program-program tersebut memiliki beragam kegiatan, antara lain:
        </p>
        <section class="grid grid-cols-4 gap-4 w-full flex-grow">
            @if (count($programs) > 0)
                @foreach ($programs as $program)
                    <a href="/program/{{ $program->id }}"
                        class="program-item border-4 rounded-md h-full {{ $loop->index >= 4 ? 'hidden' : '' }}">
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
        @if (count($programs) > 0)
            <button onclick="toggleProgram()" id="toggleProgram"
                class="text-slate-700 self-end underline font-bold mt-4">
                Lihat semua program
            </button>
        @endif
    </section>
    <section id="artikel" class="min-h-screen flex flex-col px-8 py-12 bg-gradient-to-b from-white to-[#75EBA133]">
        <div class="w-full flex md:flex-row gap-2 flex-col items-stretch">
            <aside class="md:w-1/3">
                <h1 class="text-[50px] leading-[50px] font-bold md:text-left text-center">Artikel</h1>
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
                            class="{{ $loop->index >= 4 ? 'hidden' : '' }} artikel-item flex flex-col items-start gap-3 p-6 border-4 rounded-xl">
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
                <button onclick="next()" id="nextArtikelButton">
                    <img src="/images/icons/next.svg" alt="next" class="w-32" />
                </button>
            </aside>
        </div>
        @if (count($artikels) > 0)
            <button onclick="toggleArtikel()" id="toggleArtikel"
                class="text-slate-700 self-end underline font-bold mt-4">
                Lihat semua artikel
            </button>
        @endif
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
        var programHide = true;

        function toggleProgram() {
            const programs = document.querySelectorAll('.program-item');
            programs.forEach((program, i) => {
                if (programHide) {
                    program.classList.remove('hidden');
                } else if (i >= 4) {
                    program.classList.add('hidden');
                }
            });
            document.getElementById('toggleProgram').innerText = programHide ? 'Tampilkan Lebih Sedikit' :
                'Lihat semua program';
            programHide = !programHide;
        }

        var artikelHide = true;

        function toggleArtikel() {
            const artikels = document.querySelectorAll('.artikel-item');
            artikels.forEach((artikel, i) => {
                if (artikelHide) {
                    artikel.classList.remove('hidden');
                } else if (i >= 4) {
                    artikel.classList.add('hidden');
                }
            });
            document.getElementById('toggleArtikel').innerText = artikelHide ? 'Tampilkan Lebih Sedikit' :
                'Lihat semua artikel';
            document.getElementById('backArtikelButton').classList.toggle('hidden');
            document.getElementById('nextArtikelButton').classList.toggle('hidden');
            artikelHide = !artikelHide;
        }
    </script>
</body>

</html>
