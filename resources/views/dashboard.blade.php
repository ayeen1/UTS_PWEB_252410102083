@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
{{-- Pita header navy --}}
<section class="pita relative bg-navy text-white">
    @include('partials.hiasan-pita')

    <div class="relative mx-auto flex max-w-7xl flex-col gap-6 px-4 pb-28 pt-9 sm:px-6 md:flex-row md:items-center md:justify-between md:pt-12">
        <div>
            <p class="flex items-center gap-2 text-sm text-[#DBEAFE]">
                <x-ikon nama="kalender" class="h-4 w-4" /> {{ $tanggalHariIni }}
            </p>
            {{-- $username dikirim dari PageController (diambil dari query string) --}}
            <h1 class="mt-2 font-judul text-3xl font-bold sm:text-4xl">Halo, {{ $username }} 👋</h1>
            <p class="mt-2 max-w-xl text-[15px] text-[#DBEAFE]">
                @if ($ringkasan['kelas_hari_ini'] > 0)
                    Hari ini ada {{ $ringkasan['kelas_hari_ini'] }} kelas dan {{ $tugasMingguIni }} tugas dengan deadline dalam 7 hari ke depan.
                @else
                    Tidak ada kelas hari ini. Ada {{ $tugasMingguIni }} tugas dengan deadline dalam 7 hari ke depan.
                @endif
            </p>
        </div>
        <a href="{{ route('pengelolaan', ['username' => $username]) }}"
           class="tombol-putih self-start md:self-auto">
            Lihat Jadwal &amp; Tugas <x-ikon nama="panah" class="h-4 w-4" />
        </a>
    </div>
</section>

<div class="relative mx-auto -mt-20 max-w-7xl px-4 sm:px-6">
    {{-- 3 kartu ringkasan, memakai @include + data dari controller --}}
    <div class="grid gap-4 md:grid-cols-3 md:gap-5">
        @include('partials.kartu-ringkasan', [
            'urutan' => 0,
            'ikon' => 'buku',
            'label' => 'Total Mata Kuliah',
            'angka' => $ringkasan['total_matkul'],
            'keterangan' => $ringkasan['total_tugas'].' jadwal, Senin – Jumat',
        ])
        @include('partials.kartu-ringkasan', [
            'urutan' => 1,
            'ikon' => 'clipboard',
            'label' => 'Tugas Belum Selesai',
            'angka' => $ringkasan['belum'],
            'keterangan' => $ringkasan['selesai'].' tugas sudah selesai',
        ])
        @include('partials.kartu-ringkasan', [
            'urutan' => 2,
            'ikon' => 'jam',
            'label' => 'Kelas Hari Ini',
            'angka' => $ringkasan['kelas_hari_ini'],
            'keterangan' => $ringkasan['kelas_pertama'] ? 'Kelas pertama '.$ringkasan['kelas_pertama'] : 'Tidak ada kelas',
        ])
    </div>

    <div class="mt-5 grid gap-5 lg:grid-cols-2">
        {{-- Jadwal hari ini --}}
        <section class="kartu muncul self-start p-5 sm:p-6" style="--i: 3">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="font-judul text-lg font-semibold">Jadwal Hari Ini</h2>
                <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="link-kecil">Lihat semua <x-ikon nama="panah" class="h-3.5 w-3.5" /></a>
            </div>

            {{-- @forelse: ulangi array kelas hari ini; @empty dipakai kalau array kosong (Sabtu/Minggu) --}}
            <ul class="space-y-3">
                @forelse ($kelasHariIni as $kelas)
                    <li class="muncul flex items-center gap-4 rounded-xl border border-garis bg-latar px-4 py-3.5" style="--i: {{ $loop->index + 4 }}">
                        <span class="w-14 shrink-0 border-r border-garis pr-4 text-center tabular-nums">
                            <span class="block font-judul font-bold text-navy">{{ $kelas['jam_mulai'] }}</span>
                            <span class="block text-xs text-teks-2">{{ $kelas['jam_selesai'] }}</span>
                        </span>
                        <span class="min-w-0 flex-1 font-semibold">{{ $kelas['matkul'] }}</span>
                        @if ($kelas['id'] === $idBerikutnya)
                            <span class="shrink-0 rounded-full bg-biru-muda px-2.5 py-1 text-xs font-semibold text-navy">Berikutnya</span>
                        @endif
                    </li>
                @empty
                    <li class="rounded-xl border border-dashed border-garis px-4 py-8 text-center text-sm text-teks-2">
                        Tidak ada kelas hari ini, waktunya nyicil tugas.
                    </li>
                @endforelse
            </ul>
            @if ($semuaKelasLewat)
                <p class="mt-3 text-sm text-teks-2">Kelas hari ini sudah selesai.</p>
            @endif
        </section>

        {{-- Deadline terdekat --}}
        <section class="kartu muncul p-5 sm:p-6" style="--i: 4">
            <div class="mb-2 flex items-center justify-between">
                <h2 class="font-judul text-lg font-semibold">Deadline Terdekat</h2>
                <a href="{{ route('pengelolaan', ['username' => $username]) }}" class="link-kecil">Semua tugas <x-ikon nama="panah" class="h-3.5 w-3.5" /></a>
            </div>

            <ul>
                @foreach ($deadlineTerdekat as $tugas)
                    <li class="baris-deadline muncul flex items-center gap-4 border-t border-garis py-3.5 first:border-t-0 {{ $loop->first ? 'is-terdekat' : '' }}"
                        style="--i: {{ $loop->index + 5 }}" data-tugas-id="{{ $tugas['id'] }}">
                        <span class="tanggal-deadline relative w-14 shrink-0 font-judul font-semibold tabular-nums">{{ $tugas['deadline_pendek'] }}</span>
                        <span class="min-w-0 flex-1">
                            <span class="block font-semibold leading-snug">{{ $tugas['tugas'] }}</span>
                            <span class="block text-xs text-teks-2">{{ $tugas['matkul'] }}</span>
                        </span>
                        <span class="shrink-0 text-right text-xs {{ $tugas['sisa_angka'] < 0 ? 'font-semibold text-belum' : ($loop->first ? 'font-semibold text-teks' : 'text-teks-2') }}">
                            {{ $tugas['sisa_teks'] }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
</div>
@endsection
