<nav id="akun-nav" class="mt-2 absolute hidden w-64 right-0 flex-col gap-2 bg-white drop-shadow-md p-2">
    <a href="/akun" class="flex items-center gap-2"><img src="/images/icons/user.svg" class="w-5" alt="user"> Akun</a>
    @if (session('user')['role'] === 'admin')
        <a href="/akun-dinas" class="flex items-center gap-2"><img src="/images/icons/add_user.svg" class="w-5" alt="add user">Akun Dinas Pertanian</a>
    @endif
    <a href="/logout" class="flex items-center gap-2"><img src="/images/icons/logout.svg" class="w-5" alt="logout"> Logout</a>
</nav>
