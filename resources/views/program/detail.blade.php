<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MapSeed</title>
    <link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
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
                <h1 class="text-2xl text-center">{{ session('success') }}</h1>
                <button onclick="document.querySelector('#modal').classList.add('hidden')"
                    class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
            </div>
        </div>
    @endif
    @if ($errors->any() || session('invalid'))
        <div id="modal" class="w-screen h-screen bg-[#11111155] fixed top-0 z-50 flex items-center justify-center">
            <div
                class="w-1/3 bg-green-600 px-12 py-16 font-medium text-white rounded-xl drop-shadow-xl flex flex-col gap-2 items-center">
                <h1 class="text-2xl text-center">
                    @if (session('invalid'))
                        {{ session('invalid')['message'] }}
                    @else
                        @php
                            $currError = '';
                        @endphp
                        @foreach ($errors->all() as $error)
                            @if (str_contains($error, 'required'))
                                @php
                                    $currError = '';
                                @endphp
                                Harap isi semua data
                            @break
                        @endif
                        @php
                            $currError = $error;
                        @endphp
                    @endforeach
                    @if ($currError != '')
                        Harap isi sesuai format data
                    @endif
                @endif
            </h1>
            <button onclick="document.querySelector('#modal').classList.add('hidden')"
                class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
        </div>
    </div>
@endif
<main class="mt-2 flex flex-col gap-4 px-4 pb-4 w-full">
    <a href="/" class="self-start"><img src="/images/accent/arrow.png" alt="arrow" class="rotate-180"></a>
    <img class="h-56 object-cover" src="/storage/{{ $program->foto_program }}" alt="foto program" srcset="">
    <section class="flex gap-8 bg-white mx-8 -mt-16 px-16 py-8 rounded-xl border-2 border-slate-300">
        <aside class="w-3/5">
            <h2 class="font-semibold text-lg mb-2">Informasi Program:</h2>
            <p>
                {{ $program->informasi_program }}
            </p>
        </aside>
        <aside class="w-2/5 flex flex-col items-center gap-1">
            @if (
                !session('user') ||
                    (session('user') && (session('user')['role'] === 'dealer' || session('user')['role'] === 'mitra')))
                <a href="/daftar-program/{{ $program->id }}"
                    class="w-full cursor-pointer bg-green-500 text-white px-8 py-2 rounded-md text-center mb-2">Daftar
                    Program</a>
            @endif
            <h2 class="font-semibold text-lg">Nama Program:</h2>
            <p>{{ $program->nama }}</p>
            <hr class="w-full border-2 border-slate-400 rounded-full">
            <h2 class="font-semibold text-lg">Waktu Pelaksanaan:</h2>
            <p>{{ $program->waktu_pelaksanaan }}</p>
            <hr class="w-full border-2 border-slate-400 rounded-full">
            <h2 class="font-semibold text-lg">Kuota Peserta:</h2>
            <p>{{ $program->kuota }}</p>
            <hr class="w-full border-2 border-slate-400 rounded-full">
            <h2 class="font-semibold text-lg">Tempat Pelaksanaan:</h2>
            <p>{{ $program->tempat_pelaksanaan }}</p>
            @if (session('user') && session('user')['role'] === 'dinas')
                <div class="flex gap-2 mt-2">
                    <a class="cursor-pointer bg-yellow-400 text-white px-8 py-2 rounded-md text-center"
                        href="/ubah-program/{{ $program->id }}">Ubah Data</a>
                    <a class="cursor-pointer bg-green-500 text-white px-8 py-2 rounded-md text-center"
                        href="/pendaftar-program/{{ $program->id }}">Lihat Data Pendaftar</a>
                </div>
            @endif
        </aside>
    </section>
</main>
</body>
