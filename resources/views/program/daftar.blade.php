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
                        Harap isi sesuai format data
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
    <form class="w-4/5 mx-12 flex flex-col bg-white p-8 rounded-xl gap-2" enctype="multipart/form-data"
        action="/daftar-program/{{ $program->id }}" method="POST">
        <h1 class="text-[25px] font-bold">Form Pendaftaran Program Agrikultur</h1>
        <hr class="w-full">
        @csrf
        <label for="nama">Nama
            {{ session('user') && session('user')['role'] === 'mitra' ? 'Perusahaan' : '' }}</label>
        <input type="text" name="nama" id="nama" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Nama {{ session('user') && session('user')['role'] === 'mitra' ? 'Perusahaan' : '' }}"
            value="{{ session('user') ? (session('user')['role'] === 'mitra' ? $akun->nama_perusahaan : $akun->nama_dealer) : old('nama') }}"
            {{ session('user') ? 'readonly' : '' }} />
        <label for="telepon">Nomor Telepon
            {{ session('user') && session('user')['role'] === 'mitra' ? 'Perusahaan' : '' }}</label>
        <input type="tel" name="telepon" id="telepon" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Nomor Telepon {{ session('user') && session('user')['role'] === 'mitra' ? 'Perusahaan' : '' }}"
            value="{{ session('user') ? (session('user')['role'] === 'mitra' ? $akun->telepon_perusahaan : $akun->telepon_dealer) : old('telepon') }}"
            {{ session('user') ? 'readonly' : '' }} />
        <p class="text-slate-400">*Format nomor telepon wajib diisi angka</p>
        <label for="email">Email
            {{ session('user') && session('user')['role'] === 'mitra' ? 'Perusahaan' : '' }}</label>
        <input type="email" name="email" id="email" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Email {{ session('user') && session('user')['role'] === 'mitra' ? 'Perusahaan' : '' }}"
            value="{{ session('user') ? (session('user')['role'] === 'mitra' ? $akun->email_perusahaan : $akun->email_dealer) : old('email') }}"
            {{ session('user') ? 'readonly' : '' }} />
        <label for="alamat">Alamat
            {{ session('user') && session('user')['role'] === 'mitra' ? 'Perusahaan' : '' }}</label>
        <input type="text" name="alamat" id="alamat" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Alamat {{ session('user') && session('user')['role'] === 'mitra' ? 'Perusahaan' : '' }}"
            value="{{ session('user') ? (session('user')['role'] === 'mitra' ? $akun->alamat_perusahaan : $akun->alamat_dealer) : old('alamat') }}"
            {{ session('user') ? 'readonly' : '' }} />
        <label for="pertanyaan">Pertanyaan yang Diajukan <span class="text-red-500">*</span></label>
        <textarea name="pertanyaan" id="pertanyaan" class="py-2 px-3 border-2 rounded-md w-full resize-none" cols="30"
            rows="5" placeholder="Pertanyaan yang Diajukan">{{ old('pertanyaan') }}</textarea>
        <div class="flex gap-4 mt-4">
            <input type="submit" value="Daftar"
                class="cursor-pointer bg-green-500 text-white px-8 py-2 rounded-md" />
            <a href="/program/{{ $program->id }}" class="bg-red-500 text-white px-8 py-2 rounded-md">
                Batal
            </a>
        </div>
    </form>
</main>
<script>
    document.querySelector("#foto_program").addEventListener("change", function() {
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#foto_program_preview").src = e.target.result;
            document.querySelector("#foto_program_preview").classList.remove("hidden");
            document.querySelector("#foto_program_placeholder").classList.add("hidden");
        }
        reader.readAsDataURL(file);
    });
</script>
</body>

</html>
