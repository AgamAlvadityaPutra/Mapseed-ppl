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
<main
    class="min-h-screen flex flex-col justify-center items-center z-0 bg-gradient-to-b from-white to-[#75EBA133] py-32">
    <div class="flex w-4/5 mx-12 gap-4 px-8 py-2 bg-white border-2 font-bold text-[20px]">
        <a href="/akun-dinas">Lihat Data Akun</a>
        <a href="/tambah-dinas" class="text-green-700">Buat Data Akun</a>
    </div>
    <form class="w-4/5 mx-12 flex items-start bg-white p-8 rounded-xl gap-4" enctype="multipart/form-data"
        action="/tambah-dinas" method="POST">
        @csrf
        <aside class="relative w-1/4 h-80">
            <input type="file" name="foto_dinas" id="foto_dinas"
                class="absolute top-0 left-0 py-2 px-3 border-2 rounded-md w-full h-full opacity-0"
                placeholder="Foto Dealer" accept=".jpg,.jpeg,png" />
            <img class="hidden w-full h-full object-cover" id="foto_dinas_preview">
            <div class="w-full h-full flex flex-col gap-4 items-center justify-center border-4 border-dashed"
                id="foto_dinas_placeholder">
                <img src="/images/icons/image.png">
                Upload foto
            </div>
        </aside>
        <aside class="w-3/4 flex flex-col gap-2">
            <label for="nama_dinas">Nama</label>
            <input type="text" name="nama_dinas" id="nama_dinas" class="py-2 px-3 border-2 rounded-md w-full"
                placeholder="Nama" value="{{ old('nama_dinas') }}" />
            <label for="alamat_dinas">Alamat</label>
            <input type="text" name="alamat_dinas" id="alamat_dinas" class="py-2 px-3 border-2 rounded-md w-full"
                placeholder="Alamat Dinas" value="{{ old('alamat_dinas') }}" />
            <label for="email_dinas">Email</label>
            <input type="email" name="email_dinas" id="email_dinas" class="py-2 px-3 border-2 rounded-md w-full"
                placeholder="Email" value="{{ old('email_dinas') }}" />
            <label for="telepon_dinas">Nomor Telepon</label>
            <div class="w-full">
                <input type="tel" name="telepon_dinas" id="telepon_dinas"
                class="py-2 px-3 border-2 rounded-md w-full" placeholder="08xxxxxxxxxx"
                value="{{ old('telepon_dinas') }}" />
                <p class="text-slate-400">*Format nomor telepon wajib diisi angka</p>
            </div>
            <label for="informasi_dinas">Informasi Dinas</label>
            <input type="text" name="informasi_dinas" id="informasi_dinas"
                class="py-2 px-3 border-2 rounded-md w-full" placeholder="Informasi Dinas"
                value="{{ old('informasi_dinas') }}" />
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
            <div class="flex gap-4 mt-4 self-end">
                <input type="submit" value="Daftar" class="cursor-pointer bg-green-500 text-white px-8 py-2 rounded-md" />
                <button type="button" onclick="javascript:history.back()"
                    class="bg-red-500 text-white px-8 py-2 rounded-md">
                    Batal
                </button>
            </div>
        </aside>
    </form>
</main>
<script>
    document.querySelector("#foto_dinas").addEventListener("change", function() {
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#foto_dinas_preview").src = e.target.result;
            document.querySelector("#foto_dinas_preview").classList.remove("hidden");
            document.querySelector("#foto_dinas_placeholder").classList.add("hidden");
        }
        reader.readAsDataURL(file);
    });
</script>
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
