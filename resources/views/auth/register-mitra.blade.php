<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MapSeed</title>
    <link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative">
    <header class="absolute top-0 flex justify-between items-center w-full p-6 z-50">
        <a href="/"><img src="/images/logo.png" alt="logo" class="h-[4rem]" /></a>
    </header>
    @if ($errors->any())
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
<main class="min-h-screen flex justify-center items-center z-0 bg-gradient-to-b from-white to-[#75EBA133] py-32">
    <form class="w-4/5 mx-12 flex flex-col items-start bg-white p-8 rounded-xl gap-2" enctype="multipart/form-data"
        method="POST" action="/register?role=mitra">
        @csrf
        <h1 class="font-bold text-[30px] mb-4">Kelola Akun</h1>
        <label for="nama_pimpinan_perusahaan">Nama Pimpinan Perusahaan</label>
        <input type="text" name="nama_pimpinan_perusahaan" id="nama_pimpinan_perusahaan"
            class="py-2 px-3 border-2 rounded-md w-full" placeholder="Nama Pimpinan"
            value="{{ old('nama_pimpinan_perusahaan') }}" />
        <label for="nama_perusahaan">Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" id="nama_perusahaan"
            class="py-2 px-3 border-2 rounded-md w-full" placeholder="Nama Perusahaan"
            value="{{ old('nama_perusahaan') }}" />
        <label for="telepon_perusahaan">Nomor Telepon Perusahaan</label>
        <div class="w-full">
            <input type="tel" name="telepon_perusahaan" id="telepon_perusahaan"
                class="py-2 px-3 border-2 rounded-md w-full" placeholder="08xxxxxxxxxx"
                value="{{ old('telepon_perusahaan') }}" />
            <p class="text-slate-400">*Format nomor telepon wajib diisi angka</p>
        </div>
        <label for="email_perusahaan">Email Perusahaan</label>
        <div class="w-full">
            <input type="email" name="email_perusahaan" id="email_perusahaan"
                class="py-2 px-3 border-2 rounded-md w-full" placeholder="Email"
                value="{{ old('email_perusahaan') }}" />
            <p class="text-slate-400">*Format email terdiri dari nama pengguna dan domain email</p>
        </div>
        <label for="alamat_perusahaan">Alamat Perusahaan</label>
        <input type="text" name="alamat_perusahaan" id="alamat_perusahaan"
            class="py-2 px-3 border-2 rounded-md w-full" placeholder="Alamat Perusahaan"
            value="{{ old('alamat_perusahaan') }}" />
        <label for="nomor_induk_berusaha">Nomor Induk Berusaha</label>
        <div class="w-full">
            <input type="text" name="nomor_induk_berusaha" id="nomor_induk_berusaha"
                class="py-2 px-3 border-2 rounded-md w-full" placeholder="Nomor Induk Berusaha"
                value="{{ old('nomor_induk_berusaha') }}" />
            <p class="text-slate-400">*Format karakter wajib diisi angka</p>
        </div>
        <label for="akta">Akta Perusahaan</label>
        <div class="w-full">
            <input type="file" name="akta" id="akta" class="py-2 px-3 border-2 rounded-md w-full"
                value="{{ old('akta') }}" accept=".pdf" />
            <p class="text-slate-400">*Isian dokumen harus dokumen berjenis : pdf</p>
        </div>
        <label for="npwp">NPWP</label>
        <div class="w-full">
            <input type="text" name="npwp" id="npwp" class="py-2 px-3 border-2 rounded-md w-full"
                placeholder="NPWP" value="{{ old('npwp') }}" />
            <p class="text-slate-400">*Format karakter wajib diisi angka</p>
        </div>
        <label for="surat-pernyataan">Surat Pernyataan Usaha Perseorangan</label>
        <div class="w-full">
            <input type="file" name="surat-pernyataan" id="surat-pernyataan"
                class="py-2 px-3 border-2 rounded-md w-full" value="{{ old('surat-pernyataan') }}" accept=".pdf" />
            <p class="text-slate-400">*Isian dokumen harus dokumen berjenis : pdf</p>
        </div>
        <label for="surat-izin">Surat Izin Usaha Produksi Benih</label>
        <div class="w-full">
            <input type="file" name="surat-izin" id="surat-izin" class="py-2 px-3 border-2 rounded-md w-full"
                value="{{ old('surat-izin') }}" accept=".pdf" />
            <p class="text-slate-400">*Isian dokumen harus dokumen berjenis : pdf</p>
        </div>
        <label for="informasi_perusahaan">Informasi Perusahaan</label>
        <input type="text" name="informasi_perusahaan" id="informasi_perusahaan"
            class="py-2 px-3 border-2 rounded-md w-full" placeholder="Informasi Perusahaan"
            value="{{ old('informasi_perusahaan') }}" />
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Username" value="{{ old('username') }}" />
        <label for="password">Password</label>
        <div class="w-full">
            <div class="flex border-2 rounded-md">
                <input class="w-full py-2 px-3" type="password" name="password" id="password"
                    placeholder="********" value="{{ old('password') }}" />
                <button type="button" class="py-2 px-3" id="password-toggle"><img src="/images/icons/show.svg"
                        alt="show"></button>
            </div>
            <p class="text-slate-400">*Masukkan password dengan kombinasi</p>
            <div id="password-message">
                <p class="flex items-center gap-1 text-red-500"><img src="/images/icons/Close.svg"
                        alt="close">Memiliki angka</p>
                <p class="flex items-center gap-1 text-red-500"><img src="/images/icons/Close.svg"
                        alt="close">Mengandung huruf</p>
            </div>
        </div>
        <div class="flex gap-4 mt-4">
            <input type="submit" value="Daftar"
                class="cursor-pointer bg-green-500 text-white px-8 py-2 rounded-md" />
            <a href="/" class="bg-red-500 text-white px-8 py-2 rounded-md">
                Batal
            </a>
        </div>
    </form>
</main>
<script>
    const passwordToggle = document.getElementById('password-toggle');
    passwordToggle.addEventListener('click', () => {
        const password = document.getElementById('password');
        if (password.type === 'password') {
            password.type = 'text';
            passwordToggle.innerHTML = '<img src="/images/icons/hide.svg" alt="hide">';
        } else {
            password.type = 'password';
            passwordToggle.innerHTML = '<img src="/images/icons/show.svg" alt="show">';
        }
    });
</script>
<script src="/script/password_validation.js"></script>
</body>

</html>
