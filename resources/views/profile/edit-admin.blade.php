<label for="username">Username</label>
<input type="text" name="username" id="username" class="py-2 px-3 border-2 rounded-md w-full" placeholder="Username"
    value="{{ $user['username'] }}" />
<label for="password">Password</label>
<div class="w-full" id="password-field">
    <div class="flex border-2 rounded-md">
        <input class="w-full py-2 px-3" type="password" name="password" id="password" placeholder="********"
            value="{{ $user['password'] }}" />
        <button type="button" class="py-2 px-3" id="password-toggle"><img src="/images/icons/show.svg"
                alt="show"></button>
    </div>
    <p class="text-slate-400">*Masukkan password dengan kombinasi</p>
    <div id="password-message">
        <p class="flex items-center gap-1 text-red-500"><img src="/images/icons/Close.svg" alt="close">Memiliki angka
        </p>
        <p class="flex items-center gap-1 text-red-500"><img src="/images/icons/Close.svg" alt="close">Mengandung
            huruf
        </p>
    </div>
</div>
