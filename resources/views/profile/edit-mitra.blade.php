<label for="nama_pimpinan_perusahaan">Nama Pimpinan Perusahaan</label>
<input type="text" name="nama_pimpinan_perusahaan" id="nama_pimpinan_perusahaan"
    class="py-2 px-3 border-2 rounded-md w-full" placeholder="Nama Pimpinan"
    value="{{ $akun['nama_pimpinan_perusahaan'] }}" />
<label for="nama_perusahaan">Nama Perusahaan</label>
<input type="text" name="nama_perusahaan" id="nama_perusahaan" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Nama Perusahaan" value="{{ $akun['nama_perusahaan'] }}" />
<label for="telepon_perusahaan">Nomor Telepon Perusahaan</label>
<div class="w-full">
    <input type="tel" name="telepon_perusahaan" id="telepon_perusahaan" class="py-2 px-3 border-2 rounded-md w-full"
        placeholder="08xxxxxxxxxx" value="{{ $akun['telepon_perusahaan'] }}" />
    <p class="text-slate-400">*Format nomor telepon wajib diisi angka</p>
</div>
<label for="email_perusahaan">Email Perusahaan</label>
<div class="w-full">
    <input type="email" name="email_perusahaan" id="email_perusahaan" class="py-2 px-3 border-2 rounded-md w-full"
        placeholder="Email" value="{{ $akun['email_perusahaan'] }}" />
    <p class="text-slate-400">*Format email terdiri dari nama pengguna dan domain email</p>
</div>
<label for="alamat_perusahaan">Alamat Perusahaan</label>
<input type="text" name="alamat_perusahaan" id="alamat_perusahaan" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Alamat Perusahaan" value="{{ $akun['alamat_perusahaan'] }}" />
<label for="nomor_induk_berusaha">Nomor Induk Berusaha</label>
<div class="w-full">
    <input type="text" name="nomor_induk_berusaha" id="nomor_induk_berusaha"
        class="py-2 px-3 border-2 rounded-md w-full" placeholder="Nomor Induk Berusaha"
        value="{{ $akun['nomor_induk_berusaha'] }}" />
    <p class="text-slate-400">*Format karakter wajib diisi angka</p>
</div>
<label for="akta">Akta Perusahaan</label>
<div class="relative py-2 px-3 border-2 rounded-md w-full underline flex items-center">
    <input type="file" name="akta" id="akta" class="opacity-0 w-full h-full z-10" accept=".pdf">
    <div class="absolute flex items-center w-[97%] justify-between">
        <aside id="akta_preview" class="flex items-center gap-2">
            <img src="/images/icons/attachment.svg" alt="attachment" class="h-5"> <span>Akta Perusahaan</span>
        </aside>
        <button type="button" class="bg-[#10AFB9] text-white px-2 py-1 rounded-md">Upload</button>
    </div>
</div>
<p class="text-slate-400">*Isian dokumen harus dokumen berjenis : pdf</p>
<label for="npwp">NPWP</label>
<div class="w-full">
    <input type="text" name="npwp" id="npwp" class="py-2 px-3 border-2 rounded-md w-full" placeholder="NPWP"
        value="{{ $akun['npwp'] }}" />
    <p class="text-slate-400">*Format karakter wajib diisi angka</p>
</div>
<label for="surat-pernyataan">Surat Pernyataan Usaha Perseorangan</label>
<div class="relative py-2 px-3 border-2 rounded-md w-full underline flex items-center">
    <input type="file" name="surat-pernyataan" id="surat-pernyataan" class="opacity-0 w-full h-full z-10"
        accept=".pdf">
    <div class="absolute flex items-center w-[97%] justify-between">
        <aside id="surat-pernyataan_preview" class="flex items-center gap-2">
            <img src="/images/icons/attachment.svg" alt="attachment" class="h-5"> <span>Surat Pernyataan Usaha
                Perseorangan</span>
        </aside>
        <button type="button" class="bg-[#10AFB9] text-white px-2 py-1 rounded-md">Upload</button>
    </div>
</div>
<p class="text-slate-400">*Isian dokumen harus dokumen berjenis : pdf</p>
<label for="surat-izin">Surat Izin Usaha Produksi Benih</label>
<div class="relative py-2 px-3 border-2 rounded-md w-full underline flex items-center">
    <input type="file" name="surat-izin" id="surat-izin" class="opacity-0 w-full h-full z-10" accept=".pdf">
    <div class="absolute flex items-center w-[97%] justify-between">
        <aside id="surat-izin_preview" class="flex items-center gap-2">
            <img src="/images/icons/attachment.svg" alt="attachment" class="h-5"> <span>Surat Izin Usaha Produksi
                Benih</span>
        </aside>
        <button type="button" class="bg-[#10AFB9] text-white px-2 py-1 rounded-md">Upload</button>
    </div>
</div>
<p class="text-slate-400">*Isian dokumen harus dokumen berjenis : pdf</p>
<label for="informasi_perusahaan">Informasi Perusahaan</label>
<input type="text" name="informasi_perusahaan" id="informasi_perusahaan"
    class="py-2 px-3 border-2 rounded-md w-full" placeholder="Informasi Perusahaan"
    value="{{ $akun['informasi_perusahaan'] }}" />
<label for="username">Username</label>
<input type="text" name="username" id="username" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Username" value="{{ session('user')['username'] }}" />
<label for="password">Password</label>
<div class="w-full" id="password-field">
    <div class="flex border-2 rounded-md">
        <input class="w-full py-2 px-3" type="password" name="password" id="password" placeholder="********"
            value="{{ session('user')['password'] }}" />
        <button type="button" class="py-2 px-3" id="password-toggle"><img src="/images/icons/show.svg"
                alt="show"></button>
    </div>
    <p class="text-slate-400">*Masukkan password dengan kombinasi</p>
    <div id="password-message">
        <p class="flex items-center gap-1 text-red-500"><img src="/images/icons/Close.svg" alt="close">Memiliki
            angka
        </p>
        <p class="flex items-center gap-1 text-red-500"><img src="/images/icons/Close.svg" alt="close">Mengandung
            huruf
        </p>
    </div>
</div>
