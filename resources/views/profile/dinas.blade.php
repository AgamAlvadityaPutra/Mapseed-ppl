<div class="flex w-full gap-4">
    <aside class="relative w-1/4 h-80">
        <img src="/storage/{{ $akun['foto_dinas'] }}" class="w-full h-full object-cover" id="foto_dinas_preview">
    </aside>
    <aside class="w-3/4 flex flex-col gap-2">
        <label for="nama_dinas">Nama</label>
        <input type="text" name="nama_dinas" id="nama_dinas" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Nama" disabled value="{{ $akun['nama_dinas'] }}" />
        <label for="alamat_dinas">Alamat</label>
        <input type="text" name="alamat_dinas" id="alamat_dinas" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Alamat Dealer" disabled value="{{ $akun['alamat_dinas'] }}" />
        <label for="email_dinas">Email</label>
        <input type="email" name="email_dinas" id="email_dinas" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Email" disabled value="{{ $akun['email_dinas'] }}" />
        <label for="telepon_dinas">Nomor Telepon</label>
        <input type="tel" name="telepon_dinas" id="telepon_dinas" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="08xxxxxxxxxx" disabled value="{{ $akun['telepon_dinas'] }}" />
        <label for="informasi_dinas">Informasi Dinas</label>
        <input type="text" name="informasi_dinas" id="informasi_dinas" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Informasi Dinas" disabled value="{{ $akun['informasi_dinas'] }}" />
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Username" disabled value="{{ session('user')['username'] }}" />
        <label for="password">Password</label><div class="w-full flex border-2 rounded-md">
            <input class="w-full py-2 px-3" type="password" name="password" id="password" placeholder="********"
                disabled value="{{ session("user")['password'] }}" />
            <button type="button" class="py-2 px-3" id="password-toggle"><img src="/images/icons/show.svg"
                    alt="show"></button>
        </div>
    </aside>
</div>
