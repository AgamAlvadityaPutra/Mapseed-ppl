<label for="nama_dealer">Nama</label>
<input type="text" name="nama_dealer" id="nama_dealer" class="py-2 px-3 border-2 rounded-md w-full" placeholder="Nama"
    disabled value="{{ $akun['nama_dealer'] }}" />
<label for="telepon_dealer">Nomor Telepon</label>
<input type="tel" name="telepon_dealer" id="telepon_dealer" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="08xxxxxxxxxx" disabled value="{{ $akun['telepon_dealer'] }}" />
<label for="email_dealer">Email</label>
<input type="email" name="email_dealer" id="email_dealer" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Email" disabled value="{{ $akun['email_dealer'] }}" />
<label for="alamat_dealer">Alamat Dealer</label>
<input type="text" name="alamat_dealer" id="alamat_dealer" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Alamat Dealer" disabled value="{{ $akun['alamat_dealer'] }}" />
<label for="surat_izin_distribusi">Surat Izin Distribusi</label>
<a href="/storage/{{ $akun['surat_izin_distribusi'] }}"
    class="flex items-center gap-2 py-2 px-3 border-2 rounded-md w-full underline"><img
        src="/images/icons/attachment.svg" alt="attachment" class="h-5"> Surat
    izin Distribusi</a>
<label for="foto_ktp">Foto KTP</label>
<a href="/storage/{{ $akun['foto_ktp'] }}"
    class="flex items-center gap-2 py-2 px-3 border-2 rounded-md w-full underline"><img
        src="/images/icons/attachment.svg" alt="attachment" class="h-5"> Foto KTP</a>
<label for="riwayat_kerjasama">Riwayat Kerjasama</label>
<input type="text" name="riwayat_kerjasama" id="riwayat_kerjasama" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Riwayat kerjasama" disabled value="{{ $akun['riwayat_kerjasama'] }}" />
<label for="pas_foto_dealer">Pas Foto Dealer</label>
<a href="/storage/{{ $akun['pas_foto_dealer'] }}"
    class="flex items-center gap-2 py-2 px-3 border-2 rounded-md w-full underline"><img
        src="/images/icons/attachment.svg" alt="attachment" class="h-5"> Pas Foto
    Dealer</a>
<label for="informasi_dealer">Informasi Dealer</label>
<input type="text" name="informasi_dealer" id="informasi_dealer" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Informasi Dealer" disabled value="{{ $akun['informasi_dealer'] }}" />
<label for="username">Username</label>
<input type="text" name="username" id="username" class="py-2 px-3 border-2 rounded-md w-full" placeholder="Username"
    disabled value="{{ $user['username'] }}" />
<label for="password">Password</label>
<div class="w-full flex border-2 rounded-md">
    <input class="w-full py-2 px-3" type="password" name="password" id="password" placeholder="********" disabled
        value="{{ $user['password'] }}" />
    <button type="button" class="py-2 px-3" id="password-toggle"><img src="/images/icons/show.svg"
            alt="show"></button>
</div>
