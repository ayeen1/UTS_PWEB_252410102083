@extends('layouts.app')

@section('title', 'Profil')

@section('content')
<section class="pita relative bg-navy text-white">
    @include('partials.hiasan-pita')

    <div class="relative mx-auto max-w-5xl px-4 pb-28 pt-8 sm:px-6 md:pt-11">
        <h1 class="font-judul text-3xl font-bold sm:text-4xl">Profil</h1>
        <p class="mt-2 text-[15px] text-[#DBEAFE]">Informasi akun dan ringkasan aktivitas kuliahmu.</p>
    </div>
</section>

<div class="relative mx-auto -mt-20 grid max-w-5xl gap-5 px-4 sm:px-6 lg:grid-cols-[1.15fr_1fr]">
    {{-- Kartu profil --}}
    <section class="kartu muncul self-start overflow-hidden" style="--i: 0">
        <div class="relative h-24 overflow-hidden bg-aksen sm:h-28">
            <span class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-[#F8B533]" aria-hidden="true"></span>
        </div>
        <div class="px-5 pb-6 sm:px-7">
            <div class="relative z-10 -mt-12 flex items-end gap-4">
                {{-- Foto profil, fallback ke inisial kalau file public/images/foto-profil.jpg tidak ada --}}
                @if ($adaFoto)
                    <img src="{{ asset('images/foto-profil.jpg') }}" alt="Foto profil {{ $profil['nama_lengkap'] }}"
                         class="h-24 w-24 shrink-0 rounded-full border-4 border-white bg-papan object-cover shadow-md">
                @else
                    <span class="grid h-24 w-24 shrink-0 place-items-center rounded-full border-4 border-white bg-navy font-judul text-3xl font-bold text-white shadow-md">
                        {{ strtoupper(substr($username, 0, 1)) }}
                    </span>
                @endif
                <div class="min-w-0 pb-1">
                    <h2 class="truncate font-judul text-2xl font-bold">{{ $username }}</h2>
                    <p class="text-sm text-teks-2">{{ $profil['nama_lengkap'] }}</p>
                </div>
            </div>

            <dl class="mt-6 grid gap-3 sm:grid-cols-2">
                <div class="kotak-info">
                    <dt>Username</dt>
                    {{-- username dari query string, dikirim controller --}}
                    <dd>{{ $username }}</dd>
                </div>
                <div class="kotak-info">
                    <dt>NIM</dt>
                    <dd class="tabular-nums">{{ $profil['nim'] }}</dd>
                </div>
                <div class="kotak-info sm:col-span-2">
                    <dt>Program Studi</dt>
                    <dd>{{ $profil['prodi'] }}</dd>
                </div>
            </dl>

            <hr class="my-5 border-garis">

            {{-- Logout: kembali ke halaman login (tanpa session, cukup pindah halaman) --}}
            <a href="{{ route('login') }}" class="tombol-garis">
                <x-ikon nama="keluar" class="h-4 w-4" /> Logout
            </a>
        </div>
    </section>

    <div class="space-y-5">
        {{-- Ringkasan --}}
        <section class="kartu muncul p-5 sm:p-6" style="--i: 1">
            <h2 class="font-judul text-lg font-semibold">Ringkasan</h2>
            <div class="mt-4 grid grid-cols-2 gap-3">
                <div class="rounded-xl bg-navy p-4 text-white">
                    <p class="text-xs text-[#DBEAFE]">Jumlah Mata Kuliah</p>
                    <p class="mt-1 font-judul text-3xl font-bold tabular-nums">{{ $ringkasan['total_matkul'] }}</p>
                </div>
                <div class="rounded-xl bg-selesai p-4 text-white">
                    <p class="text-xs text-[#DCFCE7]">Tugas Selesai</p>
                    <p class="mt-1 font-judul text-3xl font-bold tabular-nums">{{ $ringkasan['selesai'] }}</p>
                </div>
            </div>

            <div class="mt-4">
                <div class="flex items-center justify-between text-sm">
                    <span class="font-medium">Progres tugas</span>
                    <span class="font-bold tabular-nums"><span>{{ $ringkasan['selesai'] }}</span> / {{ $ringkasan['total_tugas'] }}</span>
                </div>
                {{-- Lebar bar diisi app.js dari 0 ke nilai sebenarnya --}}
                <div class="mt-2 h-2.5 overflow-hidden rounded-full bg-papan">
                    <div class="bar-isi h-full rounded-full bg-selesai"
                         data-isi="{{ $ringkasan['persen_selesai'] }}"></div>
                </div>
                <p class="mt-2 text-xs text-teks-2"><span>{{ $ringkasan['belum'] }}</span> tugas masih belum selesai</p>
            </div>
        </section>

        {{-- Kelas per hari --}}
        <section class="kartu muncul p-5 sm:p-6" style="--i: 2">
            <h2 class="font-judul text-lg font-semibold">Kelas per Hari</h2>
            <ul class="mt-4 space-y-3">
                @foreach ($kelasPerHari as $baris)
                    <li class="flex items-center gap-3 text-sm">
                        <span class="w-16 shrink-0">{{ $baris['hari'] }}</span>
                        <span class="h-2.5 flex-1 overflow-hidden rounded-full bg-papan">
                            <span class="bar-isi block h-full rounded-full bg-navy" data-isi="{{ $baris['persen'] }}"
                                  style="--i: {{ $loop->index }}"></span>
                        </span>
                        <span class="w-4 text-right font-bold tabular-nums">{{ $baris['jumlah'] }}</span>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
</div>
@endsection
