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
        @if (session('user') && session('user')['role'] === 'dinas')
            <a href="/tambah-program"
                class="bg-green-500 flex items-center gap-2 rounded-md px-8 py-2 font-normal text-lg text-white self-center mb-4">Tambah
                Data +</a>
        @endif
        <section class="grid grid-cols-4 gap-4 w-full flex-grow">
            @if (count($programs) > 0)
                @foreach ($programs as $program)
                    <a href="/program/{{ $program->id }}" class="program-item border-4 {{ $loop->index === 0 ? 'border-slate-600' : '' }} rounded-md h-full">
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
        <a href="/#program-pemerintah" id="toggleProgram" class="text-slate-700 self-end underline font-bold mt-4">
            Tampilkan Lebih Sedikit
        </a>
    </section>
</body>