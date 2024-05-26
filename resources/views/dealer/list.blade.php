@php
    $kecamatans = [
        'ajung',
        'ambulu',
        'arjasa',
        'balung',
        'bangsalsari',
        'gumukmas',
        'jelbuk',
        'jenggawah',
        'jombang',
        'kaliwates',
        'kencong',
        'ledokombo',
        'mayang',
        'mumbulsari',
        'pakusari',
        'panti',
        'patrang',
        'puger',
        'rambipuji',
        'sukowono',
        'semboro',
        'silo',
        'sukorambi',
        'sumberbaru',
        'sumberjambe',
        'sumbersari',
        'tanggul',
        'tempurejo',
        'umbulsari',
        'wirolegi',
        'wuluhan',
    ];
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MapSeed</title>
    <link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: rgb(34 197 94);
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: rgb(34 197 94);
        }
    </style>
</head>

<body class="grid grid-cols-4 gap-2">
    <aside class="h-screen overflow-y-auto flex flex-col px-4">
        <header class="p-8 flex justify-center">
            <a href="/"><img src="/images/logo.png" alt="logo" class="h-[4rem]"></a>
        </header>
        @if (session('user')['role'] === 'mitra')
            <div class="flex flex-col items-start pb-2">
                <p>GALERI BENIH</p>
                <a href="/galeri"
                    class="bg-green-500 flex items-center gap-2 rounded-md px-8 py-2 font-normal text-lg text-white">
                    Galeri Benih Anda
                </a>
            </div>
        @endif
        <p>KECAMATAN DI JEMBER</p>
        <nav class="flex flex-col pb-4 flex-grow overflow-y-auto">
            @foreach ($kecamatans as $currKecamatan)
                <a href="/dealer?kecamatan={{ $currKecamatan }}{{ $search ? '&search=' . $search : '' }}"
                    class="flex gap-2{{ $kecamatan === $currKecamatan ? ' text-green-500' : '' }}">
                    <img src="/images/accent/target.svg" alt="target">
                    {{ ucfirst($currKecamatan) }}
                </a>
            @endforeach
        </nav>
    </aside>
    <aside
        class="col-span-3 w-full flex flex-col h-screen overflow-y-auto bg-gradient-to-b from-white to-[#75EBA199] px-8">
        <header class="py-8 self-end">
            @include('components/plainheader')
        </header>
        <section class="bg-white p-4 rounded-xl h-[calc(100%-10rem)]">
            <form action="/dealer" method="get" class="flex items-center justify-between mb-4">
                @if ($kecamatan)
                    <input type="hidden" name="kecamatan" value="{{ $kecamatan }}">
                @endif
                <aside class="flex gap-4">
                    <a href="/mitra">Mitra Benih</a>
                    <span class="w-[2px] bg-slate-500"></span>
                    <a href="/dealer" class="text-green-500">Dealer Benih</a>
                </aside>
                <aside>
                    <label>
                        Search:
                        <input type="text" name="search" id="search-field" class="px-2 py-1 border-2 rounded-md"
                            value="{{ $search }}">
                    </label>
                    <div class="relative">
                        <div id="search-found"
                            class="hidden z-40 rounded-md mt-2 border w-full absolute bg-white px-4 p-2 flex flex-col gap-1">
                            <p>Mulai ketik di kolom pencarian</p>
                        </div>
                    </div>
                </aside>
            </form>
            @if (count($dealers) === 0)
                <p class="border h-[calc(100%-3.3rem)] flex items-center justify-center">Pencarian anda tidak ditemukan
                </p>
            @else
                <div class="border h-[calc(100%-3.3rem)] overflow-y-auto">
                    @foreach ($dealers as $dealer)
                        <a href="/dealer/{{ $dealer->id }}" class="flex items-center gap-2 px-4 py-2">
                            <div class="w-14 h-14 rounded-full bg-gray-500">
                                <img class=" rounded-full h-full w-full object-cover"
                                    src="/storage/{{ $dealer->pas_foto_dealer }}" alt="foto dealer">
                            </div>
                            <span class="text-lg font-medium text-slate-800">{{ $dealer->nama_dealer }}</span>
                        </a>
                        <hr class="mx-4 h-[2px]">
                    @endforeach
                </div>
            @endif
        </section>
    </aside>
    <script>
        const searchField = document.querySelector('#search-field');
        const searchFound = document.querySelector('#search-found');
        searchField.addEventListener('focus', () => {
            searchFound.classList.remove('hidden');
        });
        searchField.addEventListener('blur', () => {
            setTimeout(() => {
                searchFound.classList.add('hidden');
            }, 200);
        });
        searchField.addEventListener('keyup', () => {
            if (searchField.value.length > 0) {
                fetch(`/api/dealer?search=${searchField.value}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            searchFound.innerHTML =
                                '<p class="text-red-500">Pencarian anda tidak ditemukan</p>';
                        } else {
                            searchFound.innerHTML = data.map(dealer => {
                                return `<a href="/dealer/${dealer.id}" class="underline text-blue-500">${dealer.nama_dealer}</a>`;
                            }).join("");
                        }
                    });
            } else {
                searchFound.innerHTML = '<p>Mulai ketik di kolom pencarian</p>';
            }
        });
    </script>
</body>
