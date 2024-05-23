<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
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
    @if ($errors->any() || session('invalid'))
        <div id="modal" class="w-screen h-screen bg-[#11111155] fixed top-0 z-50 flex items-center justify-center">
            <div
                class="w-1/3 bg-green-600 px-12 py-16 font-medium text-white rounded-xl drop-shadow-xl flex flex-col gap-2 items-center">
                <h1 class="text-2xl">
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
                        @if (str_contains($currError, 'username') && str_contains($currError, 'taken'))
                            Username sudah terdaftar! Gunakan Username berbeda dan pastikan format data benar
                        @elseif (str_contains($currError, 'email') && str_contains($currError, 'taken'))
                            Email sudah terdaftar! Gunakan Username berbeda dan pastikan format data benar
                        @else
                            Harap isi sesuai format data
                        @endif
                    @endif
                @endif
            </h1>
            <button onclick="document.querySelector('#modal').classList.add('hidden')"
                class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
        </div>
    </div>
@endif
<div
    class="bg-[url('/images/backgrounds/Farm%201.png')] min-h-screen w-screen flex flex-col items-center justify-center bg-cover bg-center bg-no-repeat relative">
    <img src="/images/logo.png" alt="logo" />
    <form class="bg-white flex flex-col gap-4 p-6 rounded-lg w-[35%]" action="/lupa-password" method="POST">
        @csrf
        <p class="italic">
            Lupa password? Masukkan email Anda, kami kirimkan tautan untuk setel
            ulang password Anda.
        </p>
        <label for="email">Email</label>
        <input class="py-2 px-3 border-2 rounded-md" type="email" name="email" id="email"
            placeholder="nama@gmail.com" />
        <button type="submit" class="bg-green-500 text-white py-2 rounded-md">
            Kirim Tautan untuk setel ulang password via email
        </button>
        <a href="/" class="text-center bg-slate-100 text-slate-800 py-2 rounded-md">Kembali ke halaman
            utama</a>
    </form>
</div>
</body>

</html>
