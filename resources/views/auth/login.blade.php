<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div
        class="bg-[url('/images/backgrounds/Farm%201.png')] min-h-screen w-screen flex flex-col items-center justify-center bg-cover bg-center bg-no-repeat relative">
        @if ($errors->any() || session('invalid'))
            <div id="modal"
                class="w-screen h-screen bg-[#11111155] fixed top-0 z-50 flex items-center justify-center">
                <div
                    class="w-1/3 bg-green-600 px-12 py-16 font-medium text-white rounded-xl drop-shadow-xl flex flex-col gap-2">
                    <h1 class="text-2xl">
                        @if (session('invalid'))
                            {{ session('invalid')['message'] }}
                        @else
                            Username dan password harus diisi!
                        @endif
                    </h1>
                    <button onclick="document.querySelector('#modal').classList.add('hidden')"
                        class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
                </div>
            </div>
        @endif
        <img src="/images/logo.png" alt="logo" />
        <form class="bg-white flex flex-col gap-4 p-6 rounded-lg w-1/3" method="POST">
            @csrf
            <h1 class="font-bold text-[30px]">Masuk ke Akun Anda</h1>
            <label for="username">Username</label>
            <input class="py-2 px-3 border-2 rounded-md" type="text" name="username" id="username"
                placeholder="Username" value="{{ old('username') }}" />
            <label for="password">Password</label>
            <div class="flex border-2 rounded-md">
                <input class="w-full py-2 px-3" type="password" name="password" id="password" placeholder="********"
                    value="{{ old('password') }}" />
                <button type="button" class="py-2 px-3" id="password-toggle"><img src="/images/icons/show.svg"
                        alt="show"></button>
            </div>
            <a href="/lupa-password" class="text-green-500">Lupa password?</a>
            <button type="submit" class="bg-green-500 text-white py-2 rounded-md">
                Masuk
            </button>
            <a href="/" class="text-center bg-slate-100 text-slate-800 py-2 rounded-md">Kembali ke halaman
                utama</a>
            <p>Belum memiliki akun? <a href="/register" class="text-green-500">Daftar akun</a></p>
        </form>
    </div>
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
</body>

</html>
