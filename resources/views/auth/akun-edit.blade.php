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
<main class="min-h-screen flex justify-center items-center z-0 bg-gradient-to-b from-white to-[#75EBA133] py-32">
    <form class="w-4/5 mx-12 flex flex-col items-start bg-white p-8 rounded-xl gap-2" enctype="multipart/form-data"
        action="/akun-edit" method="POST">
        <h1 class="text-[25px] font-bold">Kelola Akun</h1>
        <hr class="w-full">
        @csrf
        @include('profile/edit-' . session('user')['role'], ['user' => session('user')])
        <div class="flex gap-4 mt-4">
            <input type="submit" value="Simpan"
                class="cursor-pointer bg-green-500 text-white px-8 py-2 rounded-md" />
            <a href="javascript:history.back()" class="bg-red-500 text-white px-8 py-2 rounded-md">
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
