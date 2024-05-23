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
        action="/tambah-artikel" method="POST">
        <h1 class="text-[25px] font-bold">Form Membuat Data Artikel</h1>
        <hr class="w-full">
        @csrf
        <label for="judul">Judul Artikel</label>
        <input type="text" name="judul" id="judul" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Judul Artikel" value="{{ old('judul') }}" />
        <label for="penulis">Penulis</label>
        <input type="text" name="penulis" id="penulis" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Penulis" value="{{ old('penulis') }}" />
        <label for="tanggal">Tanggal Terbit</label>
        <input type="date" name="tanggal" id="tanggal" class="py-2 px-3 border-2 rounded-md w-full"
            value="{{ old('tanggal') }}" />
        <label for="isi">Isi Artikel</label>
        <textarea name="isi" id="isi" class="py-2 px-3 border-2 rounded-md w-full resize-none" cols="30"
            rows="10" placeholder="Isi Artikel">{{ old('isi') }}</textarea>
        <label for="kata_kunci">Kata Kunci</label>
        <input type="text" name="kata_kunci" id="kata_kunci" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Kata Kunci" value="{{ old('kata_kunci') }}" />
        <label for="kesimpulan">Kesimpulan</label>
        <textarea name="kesimpulan" id="kesimpulan" class="py-2 px-3 border-2 rounded-md w-full resize-none" cols="30"
            rows="3" placeholder="Kesimpulan">{{ old('kesimpulan') }}</textarea>
        <div class="grid grid-cols-2 gap-2">
            <label class="cursor-pointer relative">
                <h2 class="my-1">Foto</h2>
                <input name="foto" id="foto" type="file"
                    class="w-0 h-0 opacity-0 absolute top-0 left-0" accept=".jpg,.jpeg,.png">
                <div
                    class="w-full h-44 border-4 border-dashed p-2 flex flex-col items-center justify-center text-slate-400 gap-2">
                    <img src="/images/icons/image.png" alt="image" class="w-10 h-10">
                    Pilih Gambar
                </div>
            </label>
            <div class="">
                <h2 class="my-1">Preview</h2>
                <div class="w-full h-44 border-4 border-yellow-400 border-dashed bg-slate-200"
                    id="foto_placeholder"></div>
                <img class="hidden w-full h-44 object-cover border-4 border-dashed border-yellow-400"
                    id="foto_preview">
            </div>
        </div>
        <p class="text-slate-400">*Tipe file yang diunggah harus berjenis Gambar : jpg, jpeg, png</p>
        <div class="flex gap-4 mt-4">
            <input type="submit" value="Simpan"
                class="cursor-pointer bg-green-500 text-white px-8 py-2 rounded-md" />
            <a href="/{{$artikel->id}}" class="bg-red-500 text-white px-8 py-2 rounded-md">
                Batal
            </a>
        </div>
    </form>
</main>
<script>
    document.querySelector("#foto").addEventListener("change", function() {
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#foto_preview").src = e.target.result;
            document.querySelector("#foto_preview").classList.remove("hidden");
            document.querySelector("#foto_placeholder").classList.add("hidden");
        }
        reader.readAsDataURL(file);
    });
</script>
</body>

</html>
