<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-control" content="private" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative">
    @include('components/header')
    <main
        class="min-h-screen flex flex-col justify-center items-center z-0 bg-gradient-to-b from-white to-[#75EBA133] py-32">
        <div class="w-4/5"><a href="/pemetaan-lahan"><img src="/images/accent/arrow.png" class="rotate-180" alt="back"></a></div>
        <div class="w-4/5 mx-12 flex items-center p-8 rounded-xl gap-10">
            <aside class="w-2/5 flex flex-col gap-2 items-center">
                <img src="/storage/{{$dinas["foto_dinas"]}}" class="h-96 w-full object-cover" alt="">
                <h1 class="text-[40px] font-black text-center">{{$dinas["nama_dinas"]}}</h1>
            </aside>
            <aside class="w-3/5 bg-white px-4 py-2 rounded-xl flex flex-col gap-1">
                <h1 class="text-[25px] font-bold">Detail Wilayah</h1>
                <hr class="w-full">
                <label class="font-semibold">Nama:</label>
                <p>{{$dinas["nama_dinas"]}}</p>
                <label class="font-semibold">Alamat:</label>
                <p>{{$dinas["alamat_dinas"]}}</p>
                <label class="font-semibold">Email:</label>
                <p>{{$dinas["email_dinas"]}}</p>
                <label class="font-semibold">Nomor Telepon:</label>
                <p>{{$dinas["telepon_dinas"]}}</p>
                <label class="font-semibold">Informasi Dinas:</label>
                <p>{{$dinas["informasi_dinas"]}}</p>
            </aside>
        </div>
    </main>
</body>

</html>
