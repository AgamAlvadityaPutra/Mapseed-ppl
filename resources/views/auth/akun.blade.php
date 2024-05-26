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
                class="w-1/3 bg-white px-12 py-16 font-medium text-slate-600 rounded-xl drop-shadow-xl flex flex-col gap-2 items-center">
                <img class="w-20" src="/images/accent/success.svg" alt="success">
                <h1 class="text-2xl">{{ session('success') }}</h1>
                <button onclick="document.querySelector('#modal').classList.add('hidden')"
                    class="bg-red-500 text-white px-8 py-2 rounded-md mt-4">Tutup</button>
            </div>
        </div>
    @endif
    <main class="min-h-screen flex justify-center items-center z-0 bg-gradient-to-b from-white to-[#75EBA133] py-32">
        <div class="w-4/5 mx-12 flex flex-col items-start bg-white p-8 rounded-xl gap-2">
            <h1 class="text-[25px] font-bold">Kelola Akun</h1>
            <hr class="w-full">
            @include('profile/' . ($isOwner ? session('user')['role'] : $role), ['user' => $user])
            @if ($isOwner)
                <a href="/akun-edit" class="bg-yellow-400 text-white px-8 py-2 rounded-md mt-4">Ubah Data</a>
            @endif
        </div>
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
</body>

</html>
