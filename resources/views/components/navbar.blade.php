{{--
    Komponen navbar. Dipanggil di layout: <x-navbar :username="$username" :active="$active" />
    - username : dibawa ke setiap link (?username=...) supaya tidak hilang saat pindah halaman
    - active   : nama route yang sedang dibuka, untuk menandai menu aktif
    - adaFoto  : true kalau public/images/foto-profil.jpg ada (kalau tidak, pakai inisial)
--}}
@props(['username', 'active' => '', 'adaFoto' => false])

<header class="sticky top-0 z-40 border-b border-garis bg-white">
    <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:h-[72px]">
        <a href="{{ route('dashboard', ['username' => $username]) }}" aria-label="KULIYAAH, ke Dashboard">
            <x-logo :ukuran="36" />
        </a>

        {{-- Menu desktop --}}
        <ul class="hidden items-center gap-2 md:flex">
            <li>
                <a href="{{ route('dashboard', ['username' => $username]) }}"
                   class="nav-link {{ $active === 'dashboard' ? 'is-active' : '' }}">
                    <x-ikon nama="dashboard" /> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('pengelolaan', ['username' => $username]) }}"
                   class="nav-link {{ $active === 'pengelolaan' ? 'is-active' : '' }}">
                    <x-ikon nama="kalender" /> Jadwal &amp; Tugas
                </a>
            </li>
            <li>
                <a href="{{ route('profile', ['username' => $username]) }}"
                   class="nav-link {{ $active === 'profile' ? 'is-active' : '' }}">
                    <x-ikon nama="profil" /> Profil
                </a>
            </li>
        </ul>

        {{-- Info pengguna (desktop) --}}
        <div class="hidden items-center gap-3 md:flex">
            @if ($adaFoto)
                <img src="{{ asset('images/foto-profil.jpg') }}" alt="" class="h-9 w-9 rounded-full object-cover">
            @else
                <span class="grid h-9 w-9 place-items-center rounded-full bg-papan text-sm font-bold text-teks">
                    {{ strtoupper(substr($username, 0, 1)) }}
                </span>
            @endif
            <span class="leading-tight">
                <span class="block max-w-[140px] truncate text-sm font-semibold">{{ $username }}</span>
                <span class="block text-xs text-teks-2">Mahasiswa</span>
            </span>
        </div>

        {{-- Tombol hamburger (mobile) --}}
        <button type="button" id="tombol-menu" class="grid h-11 w-11 place-items-center rounded-xl border border-garis text-navy md:hidden"
                aria-label="Buka menu" aria-expanded="false" aria-controls="panel-menu">
            <x-ikon nama="menu" class="h-6 w-6" />
        </button>
    </nav>

    {{-- Panel menu mobile: meluncur dari kanan (diatur oleh app.js + app.css) --}}
    <div id="latar-menu" class="latar-menu md:hidden" hidden></div>
    <aside id="panel-menu" class="panel-menu md:hidden" aria-label="Menu" hidden>
        <div class="flex items-center justify-between border-b border-garis px-4 h-16">
            <x-logo :ukuran="32" />
            <button type="button" id="tutup-menu" class="grid h-11 w-11 place-items-center rounded-xl bg-navy text-white" aria-label="Tutup menu">
                <x-ikon nama="tutup" class="h-5 w-5" />
            </button>
        </div>
        <div class="p-4">
            <div class="mb-4 flex items-center gap-3 rounded-2xl border border-garis bg-latar p-3">
                @if ($adaFoto)
                    <img src="{{ asset('images/foto-profil.jpg') }}" alt="" class="h-11 w-11 shrink-0 rounded-full object-cover">
                @else
                    <span class="grid h-11 w-11 shrink-0 place-items-center rounded-full bg-papan font-bold">
                        {{ strtoupper(substr($username, 0, 1)) }}
                    </span>
                @endif
                <span class="min-w-0 leading-tight">
                    <span class="block truncate font-semibold">{{ $username }}</span>
                    <span class="block text-sm text-teks-2">Mahasiswa · Teknologi Informasi</span>
                </span>
            </div>
            <a href="{{ route('dashboard', ['username' => $username]) }}" class="menu-mobile {{ $active === 'dashboard' ? 'is-active' : '' }}">
                <x-ikon nama="dashboard" class="h-5 w-5" /> Dashboard
            </a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="menu-mobile {{ $active === 'pengelolaan' ? 'is-active' : '' }}">
                <x-ikon nama="kalender" class="h-5 w-5" /> Jadwal &amp; Tugas
            </a>
            <a href="{{ route('profile', ['username' => $username]) }}" class="menu-mobile {{ $active === 'profile' ? 'is-active' : '' }}">
                <x-ikon nama="profil" class="h-5 w-5" /> Profil
            </a>
        </div>
    </aside>
</header>
