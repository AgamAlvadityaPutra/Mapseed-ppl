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
    <img class="h-56 object-cover" src="/storage/{{ $artikel->foto }}" alt="foto artikel" srcset="">
    <section class="flex flex-col gap-2 bg-white -mt-16 px-16 py-8 rounded-2xl border-2 border-slate-300">
        <h1 class="font-bold text-4xl">{{ $artikel->judul }}</h1>
        <p class="flex gap-2">
            <span class="bg-teal-400 text-white px-4 py-1 rounded-md">{{ $artikel->penulis }}</span>
            <span class="bg-teal-400 text-white px-4 py-1 rounded-md">{{ $artikel->tanggal }}</span>
        </p>
        <pre class="text-wrap whitespace-pre-line mt-2 font-sans">
            {{ $artikel->isi }}
        </pre>
        <div class="flex gap-2 bg-teal-100 text-teal-400 font-semibold">
            <span class="bg-teal-400 w-7"></span>
            <p class="pe-2 py-4">{{ $artikel->kesimpulan }}</p>
        </div>
        <p class="bg-teal-400 p-4 rounded-lg w-3/4">Kata Kunci: <br>{{ $artikel->kata_kunci }}</p>
        @if (session('user') && session('user')['role'] == 'dinas')
            <a href="/ubah-artikel/{{ $artikel->id }}" class="bg-yellow-400 text-white self-start px-4 py-1 rounded-md">Ubah Data</a>
        @endif
    </section>
</main>
</body>
