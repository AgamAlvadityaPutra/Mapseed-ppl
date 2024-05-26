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
    @include('components/header')
    @if (session('success'))
        <div id="modal" class="w-screen h-screen bg-[#11111155] fixed top-0 z-50 flex items-center justify-center">
            <div
                class="w-1/3 bg-white px-12 py-16 font-medium  text-slate-600 rounded-xl drop-shadow-xl flex flex-col gap-2 items-center">
                <img class="w-20" src="/images/accent/success.svg" alt="success">
                <h1 class="text-2xl">{{ session('success') }}</h1>
                <button onclick="document.querySelector('#modal').classList.add('hidden')"
                    class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
            </div>
        </div>
    @endif
    <main
        class="min-h-screen flex flex-col justify-center items-center z-0 bg-gradient-to-b from-white to-[#75EBA133] py-32">
        <div class="flex w-4/5 mx-12 gap-4 px-8 py-2 bg-white border-2 font-bold text-[20px]">
            <a href="/akun-dinas" class="text-green-700">Lihat Data Akun</a>
            <a href="/tambah-dinas">Buat Data Akun</a>
        </div>
        <div class="w-4/5 mx-12 flex items-start bg-white p-8 rounded-xl gap-4" enctype="multipart/form-data">
            <aside class="relative w-1/4 h-80">
                <img src="/storage/{{ $dinas['foto_dinas'] }}" class="w-full h-full object-cover"
                    id="foto_dinas_preview">
            </aside>
            <aside class="w-3/4 flex flex-col gap-2">
                <label for="nama_dinas">Nama</label>
                <input type="text" name="nama_dinas" id="nama_dinas" class="py-2 px-3 border-2 rounded-md w-full"
                    placeholder="Nama" value="{{ $dinas['nama_dinas'] }}" disabled />
                <label for="alamat_dinas">Alamat</label>
                <input type="text" name="alamat_dinas" id="alamat_dinas" class="py-2 px-3 border-2 rounded-md w-full"
                    placeholder="Alamat Dealer" value="{{ $dinas['alamat_dinas'] }}" disabled />
                <label for="email_dinas">Email</label>
                <input type="email" name="email_dinas" id="email_dinas" class="py-2 px-3 border-2 rounded-md w-full"
                    placeholder="Email" value="{{ $dinas['email_dinas'] }}" disabled />
                <label for="telepon_dinas">Nomor Telepon</label>
                <input type="tel" name="telepon_dinas" id="telepon_dinas"
                    class="py-2 px-3 border-2 rounded-md w-full" placeholder="08xxxxxxxxxx"
                    value="{{ $dinas['telepon_dinas'] }}" disabled />
                <label for="informasi_dinas">Informasi Dinas</label>
                <input type="text" name="informasi_dinas" id="informasi_dinas"
                    class="py-2 px-3 border-2 rounded-md w-full" placeholder="Informasi Dinas"
                    value="{{ $dinas['informasi_dinas'] }}" disabled />
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="py-2 px-3 border-2 rounded-md w-full"
                    placeholder="Username" value="{{ $dinas->credential['username'] }}" disabled />
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="py-2 px-3 border-2 rounded-md w-full"
                    placeholder="********" value="{{ $dinas->credential['password'] }}" disabled />
            </aside>
        </div>
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
</body>

</html>
