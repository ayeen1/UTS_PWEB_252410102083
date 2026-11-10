@extends('layouts.app')

@section('title', 'Masuk')
@section('body_class', 'bg-navy')

@section('content')
<section class="relative flex min-h-screen items-center justify-center overflow-hidden bg-navy px-4 py-10">

    @include('partials.hiasan-pita')

    <div class="pointer-events-none absolute inset-0 hidden md:block" aria-hidden="true">
        <span class="ikon-hias left-[11%] top-[20%]" style="--d: 0s">
            <x-ikon nama="clipboard" class="h-6 w-6" />
        </span>
        <span class="ikon-hias ikon-hias-aksen right-[13%] top-[16%] rotate-6" style="--d: .8s">
            <x-ikon nama="alarm" class="h-8 w-8" />
        </span>
        <span class="ikon-hias right-[16%] bottom-[22%]" style="--d: 1.6s">
            <x-ikon nama="idcard" class="h-6 w-6" />
        </span>
        <span class="ikon-hias left-[15%] bottom-[18%] rounded-full" style="--d: 2.4s">
            <x-ikon nama="kalender" class="h-5 w-5 text-aksen" />
        </span>
    </div>

    <div class="kartu-login relative w-full max-w-[420px] rounded-3xl bg-white px-6 py-8 shadow-[0_24px_48px_-12px_rgba(15,23,42,.35)] sm:px-9 sm:py-10">
        <div class="flex justify-center">
            <x-logo :ukuran="48" />
        </div>
        <h1 class="mt-6 text-center font-judul text-2xl font-semibold">Masuk ke KULIYAAH</h1>
        <p class="mx-auto mt-2 max-w-[300px] text-center text-sm leading-relaxed text-teks-2">
            Atur jadwal kuliah dan pantau deadline tugas dalam satu tempat.
        </p>

        @session('gagal')
            <p class="mt-6 rounded-xl bg-belum px-4 py-3 text-sm font-semibold text-white" role="alert">{{ $value }}</p>
        @endsession

        <form action="{{ route('login.proses') }}" method="POST" class="mt-7 space-y-4" novalidate>
            @csrf

            <div>
                <label for="username" class="mb-1.5 block text-sm font-semibold">Username</label>
                <div class="input-ikon @error('username') is-error @enderror">
                    <x-ikon nama="profil" class="h-[18px] w-[18px] text-teks-2" />
                    <input id="username" name="username" type="text" value="{{ old('username') }}"
                           placeholder="Masukkan username" autocomplete="username" autofocus>
                </div>
                @error('username')
                    <p class="mt-1.5 text-sm font-medium text-belum">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1.5 block text-sm font-semibold">Password</label>
                <div class="input-ikon @error('password') is-error @enderror">
                    <x-ikon nama="gembok" class="h-[18px] w-[18px] text-teks-2" />
                    <input id="password" name="password" type="password" placeholder="Masukkan password" autocomplete="current-password">
                    <button type="button" id="tombol-password" class="shrink-0 rounded-md px-1.5 py-1 text-xs font-semibold text-navy"
                            aria-controls="password" aria-pressed="false">Tampilkan</button>
                </div>
                @error('password')
                    <p class="mt-1.5 text-sm font-medium text-belum">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="tombol-utama mt-2 w-full">
                Masuk <x-ikon nama="panah" class="h-4 w-4" />
            </button>
        </form>

        <p class="mt-5 text-center text-xs text-teks-2">Jadwal &amp; tugas kuliah, Teknologi Informasi</p>
    </div>
</section>
@endsection
