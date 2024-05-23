@if (session('user'))
    <aside class="flex items-center gap-4">
        <div class="relative">
            <a href="/mitra" class="flex gap-2 items-center text-lg bg-white border-2 px-2 py-1 rounded-md"><img src="/images/icons/search_gray.svg" alt="search">Searcher</a>
        </div>
        <div class="relative">
            <button class="w-14 h-14 rounded-full" id="akun-btn"><img src="/images/profile.png" alt="profile"
                    class="w-full h-full object-cover"></button>
            @include('components/popupnav')
        </div>
    </aside>
    <script>
        document.querySelector('#akun-btn').addEventListener('click', () => {
            document.querySelector('#akun-nav').classList.toggle('hidden');
            document.querySelector('#akun-nav').classList.toggle('flex');
        });
    </script>
@else
    <nav class="w-1/4 flex gap-[20px]">
        <a href="/register"
            class="flex-grow text-center font-medium bg-white border border-[#E5E7EB] text-[#2EC55E] px-4 py-2 rounded-[5px]">Register</a>
        <a href="/login"
            class="flex-grow text-center font-medium bg-[#2EC55E] border border-[#2EC55E] text-white px-4 py-2 rounded-[5px]">Login</a>
    </nav>
@endif
