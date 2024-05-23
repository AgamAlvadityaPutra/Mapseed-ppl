<div class="flex w-full gap-4">
    <aside class="relative w-1/4 h-80">
        <input type="file" name="foto_dinas" id="foto_dinas"
            class="absolute top-0 left-0 py-2 px-3 border-2 rounded-md w-full h-full opacity-0" placeholder="Foto Dealer"
            accept=".jpg,.jpeg,.png" />
        <img src="/storage/{{ $akun['foto_dinas'] }}" class="w-full h-full object-cover" id="foto_dinas_preview">
    </aside>
    <aside class="w-3/4 flex flex-col gap-2">
        <label for="nama_dinas">Nama</label>
        <input type="text" name="nama_dinas" id="nama_dinas" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Nama" value="{{ $akun['nama_dinas'] }}" />
        <label for="alamat_dinas">Alamat</label>
        <input type="text" name="alamat_dinas" id="alamat_dinas" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Alamat Dealer" value="{{ $akun['alamat_dinas'] }}" />
        <label for="email_dinas">Email</label>
        <input type="email" name="email_dinas" id="email_dinas" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Email" value="{{ $akun['email_dinas'] }}" />
        <label for="telepon_dinas">Nomor Telepon</label>
        <input type="tel" name="telepon_dinas" id="telepon_dinas" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="08xxxxxxxxxx" value="{{ $akun['telepon_dinas'] }}" />
        <p class="text-slate-400">*Format nomor telepon wajib diisi angka</p>
        <label for="informasi_dinas">Informasi Dinas</label>
        <input type="text" name="informasi_dinas" id="informasi_dinas" class="py-2 px-3 border-2 rounded-md w-full"
            placeholder="Informasi Dinas" value="{{ $akun['informasi_dinas'] }}" />
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
                <p class="flex items-center gap-1 text-red-500"><img src="/images/icons/Close.svg"
                        alt="close">Memiliki angka</p>
                <p class="flex items-center gap-1 text-red-500"><img src="/images/icons/Close.svg"
                        alt="close">Mengandung huruf
                </p>
            </div>
        </div>
    </aside>
</div>
<script>
    document.querySelector("#foto_dinas").addEventListener("change", function() {
        const file = this.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#foto_dinas_preview").src = e.target.result;
            document.querySelector("#foto_dinas_preview").classList.remove("hidden");
            document.querySelector("#foto_dinas_placeholder").classList.add("hidden");
        }
        reader.readAsDataURL(file);
    });
</script>
