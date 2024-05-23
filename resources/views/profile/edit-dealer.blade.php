<label for="nama_dealer">Nama</label>
<input type="text" name="nama_dealer" id="nama_dealer" class="py-2 px-3 border-2 rounded-md w-full" placeholder="Nama"
    value="{{ $akun['nama_dealer'] }}" />
<label for="telepon_dealer">Nomor Telepon</label>
<div class="w-full">
    <input type="tel" name="telepon_dealer" id="telepon_dealer" class="py-2 px-3 border-2 rounded-md w-full"
        placeholder="08xxxxxxxxxx" value="{{ $akun['telepon_dealer'] }}" />
    <p class="text-slate-400">*Format nomor telepon wajib diisi angka</p>
</div>
<label for="email_dealer">Email</label>
<div class="w-full">
    <input type="email" name="email_dealer" id="email_dealer" class="py-2 px-3 border-2 rounded-md w-full"
        placeholder="Email" value="{{ $akun['email_dealer'] }}" />
    <p class="text-slate-400">*Format email terdiri dari nama pengguna dan domain email</p>
</div>
<label for="alamat_dealer">Alamat Dealer</label>
<input type="text" name="alamat_dealer" id="alamat_dealer" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Alamat Dealer" value="{{ $akun['alamat_dealer'] }}" />
<label for="surat_izin_distribusi">Surat Izin Distribusi</label>
<div class="relative py-2 px-3 border-2 rounded-md w-full underline flex items-center">
    <input type="file" name="surat_izin_distribusi" id="surat_izin_distribusi" class="opacity-0 w-full h-full z-10"
        accept=".pdf">
    <div class="absolute flex items-center w-[97%] justify-between">
        <aside id="surat_izin_distribusi_preview" class="flex items-center gap-2">
            <img src="/images/icons/attachment.svg" alt="attachment" class="h-5"> <span>Surat izin Distribusi</span>
        </aside>
        <button type="button" class="bg-[#10AFB9] text-white px-2 py-1 rounded-md">Upload</button>
    </div>
</div>
<p class="text-slate-400">*Isian dokumen harus dokumen berjenis : pdf</p>
<label for="foto_ktp">Foto KTP</label>
<div class="relative py-2 px-3 border-2 rounded-md w-full underline flex items-center">
    <input type="file" name="foto_ktp" id="foto_ktp" class="opacity-0 w-full h-full z-10" accept=".jpg,.jpeg,.png">
    <div class="absolute flex items-center w-[97%] justify-between">
        <aside id="foto_ktp_preview" class="flex items-center gap-2">
            <img src="/images/icons/attachment.svg" alt="attachment" class="h-5"> <span>Foto KTP</span>
        </aside>
        <button type="button" class="bg-[#10AFB9] text-white px-2 py-1 rounded-md">Upload</button>
    </div>
</div>
<p class="text-slate-400">*Tipe file yang diunggah harus berjenis Gambar : jpg, jpeg, png</p>
<label for="riwayat_kerjasama">Riwayat Kerjasama</label>
<input type="text" name="riwayat_kerjasama" id="riwayat_kerjasama" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Riwayat kerjasama" value="{{ $akun['riwayat_kerjasama'] }}" />
<label for="pas_foto_dealer">Pas Foto Dealer</label>
<div class="relative py-2 px-3 border-2 rounded-md w-full underline flex items-center">
    <input type="file" name="pas_foto_dealer" id="pas_foto_dealer" class="opacity-0 w-full h-full z-10"
        accept=".jpg,.jpeg,.png">
    <div class="absolute flex items-center w-[97%] justify-between">
        <aside id="pas_foto_dealer_preview" class="flex items-center gap-2">
            <img src="/images/icons/attachment.svg" alt="attachment" class="h-5"> <span>Pas Foto Dealer</span>
        </aside>
        <button type="button" class="bg-[#10AFB9] text-white px-2 py-1 rounded-md">Upload</button>
    </div>
</div>
<p class="text-slate-400">*Tipe file yang diunggah harus berjenis Gambar : jpg, jpeg, png</p>
<label for="informasi_dealer">Informasi Dealer</label>
<input type="text" name="informasi_dealer" id="informasi_dealer" class="py-2 px-3 border-2 rounded-md w-full"
    placeholder="Informasi Dealer" value="{{ $akun['informasi_dealer'] }}" />
<label for="username">Username</label>
<input type="text" name="username" id="username" class="py-2 px-3 border-2 rounded-md w-full" placeholder="Username"
    value="{{ session('user')['username'] }}" />
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

<script>
    document.querySelector("#surat_izin_distribusi").addEventListener("change", function() {
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#surat_izin_distribusi_preview").innerHTML =
                `<img src="/images/icons/attachment.svg" alt="attachment" class="h-5"> ${file.name}`;
        }
        reader.readAsDataURL(file);
    });
    document.querySelector("#foto_ktp").addEventListener("change", function() {
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#foto_ktp_preview").innerHTML =
                `<img src="/images/icons/attachment.svg" alt="attachment" class="h-5"> ${file.name}`;
        }
        reader.readAsDataURL(file);
    });
    document.querySelector("#pas_foto_dealer").addEventListener("change", function() {
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#pas_foto_dealer_preview").innerHTML =
                `<img src="/images/icons/attachment.svg" alt="attachment" class="h-5"> ${file.name}`;
        }
        reader.readAsDataURL(file);
    });
</script>
