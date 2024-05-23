<label for="nama_pimpinan_perusahaan">Nama Pimpinan Perusahaan</label>
<input type="text" name="nama_pimpinan_perusahaan" id="nama_pimpinan_perusahaan"
    class="py-2 px-3 border-2 rounded-md w-full" placeholder="Nama Pimpinan" disabled
    value="{{ $akun['nama_pimpinan_perusahaan'] }}" />
<label for="nama_perusahaan">Nama Perusahaan</label>
<input type="text" name="nama_perusahaan" id="nama_perusahaan" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Nama Perusahaan" disabled value="{{ $akun['nama_perusahaan'] }}" />
<label for="telepon_perusahaan">Nomor Telepon Perusahaan</label>
<input type="tel" name="telepon_perusahaan" id="telepon_perusahaan" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="08xxxxxxxxxx" disabled value="{{ $akun['telepon_perusahaan'] }}" />
<label for="email_perusahaan">Email Perusahaan</label>
<input type="email" name="email_perusahaan" id="email_perusahaan" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Email" disabled value="{{ $akun['email_perusahaan'] }}" />
<label for="alamat_perusahaan">Alamat Perusahaan</label>
<input type="text" name="alamat_perusahaan" id="alamat_perusahaan" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Alamat Perusahaan" disabled value="{{ $akun['alamat_perusahaan'] }}" />
<label for="nomor_induk_berusaha">Nomor Induk Berusaha</label>
<input type="text" name="nomor_induk_berusaha" id="nomor_induk_berusaha" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Nomor Induk Berusaha" disabled value="{{ $akun['nomor_induk_berusaha'] }}" />
<label for="akta">Akta Perusahaan</label>
<a href="/storage/{{ $akun['akta_perusahaan'] }}"
    class="flex items-center gap-2 py-2 px-3 border-2 rounded-md w-full underline"><img
        src="/images/icons/attachment.svg" alt="attachment" class="h-5">Akta Perusahaan</a>
<label for="npwp">NPWP</label>
<input type="text" name="npwp" id="npwp" class="py-2 px-3 border-2 rounded-md w-full" placeholder="NPWP"
    disabled value="{{ $akun['npwp'] }}" />
<label for="surat-pernyataan">Surat Pernyataan Usaha Perseorangan</label>
<a href="/storage/{{ $akun['surat_pernyataan_usaha_perseorangan'] }}"
    class="flex items-center gap-2 py-2 px-3 border-2 rounded-md w-full underline"><img
        src="/images/icons/attachment.svg" alt="attachment" class="h-5">Surat Pernyataan Usaha Perseorangan</a>
<label for="npwp">NPWP</label>
<label for="surat-izin">Surat Izin Usaha Produksi Benih</label>
<a href="/storage/{{ $akun['surat_izin_usaha_produksi_benih'] }}"
    class="flex items-center gap-2 py-2 px-3 border-2 rounded-md w-full underline"><img
        src="/images/icons/attachment.svg" alt="attachment" class="h-5">Surat Izin Usaha Produksi Benih</a>
<label for="informasi_perusahaan">Informasi Perusahaan</label>
<input type="text" name="informasi_perusahaan" id="informasi_perusahaan" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Informasi Perusahaan" disabled value="{{ $akun['informasi_perusahaan'] }}" />
<label for="username">Username</label>
<input type="text" name="username" id="username" class="py-2 px-3 border-2 rounded-md w-full" placeholder="Username"
    disabled value="{{ session('user')['username'] }}" />
<label for="password">Password</label>
<div class="w-full flex border-2 rounded-md">
    <input class="w-full py-2 px-3" type="password" name="password" id="password" placeholder="********" disabled
        value="{{ $user['password'] }}" />
    <button type="button" class="py-2 px-3" id="password-toggle"><img src="/images/icons/show.svg"
            alt="show"></button>
</div>
