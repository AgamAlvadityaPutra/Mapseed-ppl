<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MapSeed</title>
    <link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div
        class="bg-[url('/images/backgrounds/Farm%201.png')] min-h-screen w-screen flex flex-col items-center justify-center bg-cover bg-center bg-no-repeat relative">
        <img src="/images/logo.png" alt="logo" />
        <form class="bg-white flex flex-col gap-4 p-6 rounded-lg w-1/3" action="/reset-password/{{ $token }}"
            method="POST">
            @csrf
            <h1 class="font-bold text-[30px]">Setel ulang password</h1>
            <label for="email">Email</label>
            <input class="py-2 px-3 border-2 rounded-md" type="email" name="email" id="email"
                placeholder="nama@gmail.com" />
            <label for="password">Password</label>
            <div class="w-full">
                <div class="flex border-2 rounded-md">
                    <input class="w-full py-2 px-3" type="password" name="password" id="password"
                        placeholder="********" />
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
            <label for="password-valid">Konfirmasi Password</label>
            <div class="flex border-2 rounded-md">
                <input class="w-full py-2 px-3" type="password" name="password-valid" id="password-valid"
                    placeholder="********" />
                <button type="button" class="py-2 px-3" id="password-valid-toggle"><img src="/images/icons/show.svg"
                        alt="show"></button>
            </div>
            <button type="submit" class="bg-green-500 text-white py-2 rounded-md">
                Setel Ulang password
            </button>
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
        const passwordValidToggle = document.getElementById('password-valid-toggle');
        passwordValidToggle.addEventListener('click', () => {
            const passwordValid = document.getElementById('password-valid');
            if (passwordValid.type === 'password') {
                passwordValid.type = 'text';
                passwordValidToggle.innerHTML = '<img src="/images/icons/hide.svg" alt="hide">';
            } else {
                passwordValid.type = 'password';
                passwordValidToggle.innerHTML = '<img src="/images/icons/show.svg" alt="show">';
            }
        });
    </script>
    <script src="/script/password_validation.js"></script>
</body>

</html>
