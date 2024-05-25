<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
</head>

<body class="relative min-h-screen flex flex-col items-center px-6 bg-gradient-to-b from-white to-[#75EBA199]">
    <header class="flex justify-between items-center w-full py-6 z-50">
        <a href="/"><img src="/images/logo.png" alt="logo" class="h-[4rem]" /></a>
        @include('components/plainheader')
    </header>

    <main class="mt-2 flex flex-col gap-4 px-4 pb-4 w-full">
        <a href="/program/{{ $program->id }}" class="self-start"><img src="/images/accent/arrow.png" alt="arrow"
                class="rotate-180"></a>
        <div class="p-4 rounded-xl flex flex-col gap-1 mt-2 bg-white">
            <h1 class="text-[25px] font-bold">Data Pendaftar {{ $program->nama }}</h1>
            <hr class="w-full">
            <p class="self-end border-2 px-2 py-1 font-semibold">{{ count($program->members) }}/{{ $program->kuota }}
                Kuota</p>
            <table id="table-wilayah" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pendaftar</th>
                        <th>Nomor Pendaftar</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Pertanyaan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($program->members as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $member->nama }}</td>
                            <td>{{ $member->telepon }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->alamat }}</td>
                            <td>{{ $member->pertanyaan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <script>
        new DataTable('#table-wilayah', {
            searching: false,
            paging: false,
            info: false
        });
    </script>
</body>
