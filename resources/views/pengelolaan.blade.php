@extends('layouts.app')

@section('title', 'Jadwal & Tugas')

@section('content')
<section class="pita relative bg-navy text-white">
    @include('partials.hiasan-pita')

    <div class="relative mx-auto max-w-7xl px-4 pb-24 pt-8 sm:px-6 md:pb-28 md:pt-11">
        <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="font-judul text-3xl font-bold sm:text-4xl">Jadwal &amp; Tugas</h1>
                <p class="mt-2 max-w-xl text-[15px] text-[#DBEAFE]">
                    {{ $ringkasan['total_tugas'] }} jadwal dari {{ $ringkasan['total_matkul'] }} mata kuliah, Senin – Jumat.
                    <span class="hidden md:inline">Klik label status di kartu untuk menandai tugas selesai.</span>
                    <span class="md:hidden">Geser untuk hari lain.</span>
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <span class="chip-ringkas bg-selesai"><x-ikon nama="centang" class="h-3.5 w-3.5" /> <b data-hitung="selesai">{{ $ringkasan['selesai'] }}</b> Selesai</span>
                <span class="chip-ringkas bg-belum"><x-ikon nama="jam" class="h-3.5 w-3.5" /> <b data-hitung="belum">{{ $ringkasan['belum'] }}</b> Belum</span>
            </div>
        </div>

        <div class="mt-5 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <p class="hidden items-center gap-2 text-sm font-semibold md:flex">
                <span class="h-2 w-2 rounded-full bg-aksen"></span> Minggu ini · {{ $rentangMinggu }}
            </p>
            <label class="kotak-cari w-full md:w-[320px]">
                <x-ikon nama="cari" class="h-[18px] w-[18px] text-teks-2" />
                <span class="sr-only">Cari mata kuliah atau tugas</span>
                <input id="cari" type="search" placeholder="Cari mata kuliah atau tugas..." autocomplete="off">
            </label>
        </div>

        <div class="mt-4 flex gap-2 md:hidden" role="tablist" aria-label="Pilih hari">
            @foreach ($daftarHari as $hari)
                <button type="button" class="tab-hari {{ $hari === $hariIni ? 'is-hari-ini' : '' }}"
                        data-index="{{ $loop->index }}" role="tab">{{ substr($hari, 0, 3) }}</button>
            @endforeach
        </div>
    </div>
</section>

<div class="relative mx-auto -mt-16 max-w-7xl md:-mt-20 md:px-6">
    <div id="papan" class="papan" data-hari-ini="{{ $indexHariIni }}">
        @foreach ($daftarHari as $hari)
            @php($isiHari = $jadwalPerHari[$hari] ?? [])
            <section class="kolom-hari {{ $hari === $hariIni ? 'is-hari-ini' : '' }}" aria-label="{{ $hari }}">
                <header class="mb-3 flex items-center gap-2 px-1">
                    <span class="h-2.5 w-2.5 rounded-full" style="background: {{ $warnaHari[$hari] }}"></span>
                    <h2 class="font-judul text-[15px] font-semibold">{{ $hari }}</h2>
                    <span class="rounded-full bg-white px-2 text-xs font-semibold text-teks-2">{{ count($isiHari) }}</span>
                    @if ($hari === $hariIni)
                        <span class="whitespace-nowrap rounded-full bg-navy px-2 py-0.5 text-[11px] font-semibold text-white">Hari ini</span>
                    @endif
                    <x-ikon nama="titik3" class="ml-auto h-5 w-5 text-teks-2" />
                </header>

                <div class="space-y-3">
                    @forelse ($isiHari as $item)
                        <x-kartu-matkul :item="$item" :urutan="$loop->index + $loop->parent->index" />
                    @empty
                        <p class="rounded-xl bg-white px-4 py-6 text-center text-sm text-teks-2">Tidak ada kelas.</p>
                    @endforelse
                </div>
            </section>
        @endforeach
    </div>

    <p id="cari-kosong" class="mx-4 mt-2 hidden rounded-2xl bg-white px-4 py-8 text-center text-teks-2 md:mx-0">
        Tidak ada mata kuliah atau tugas yang cocok.
    </p>

    <div class="mt-4 flex flex-col items-center gap-2 md:hidden">
        <div class="flex items-center gap-1.5" id="indikator">
            @foreach ($daftarHari as $hari)
                <span class="titik-indikator" data-index="{{ $loop->index }}"></span>
            @endforeach
        </div>
        <p class="text-sm text-teks-2">Geser ke kiri/kanan untuk hari lain</p>
    </div>
</div>
@endsection
