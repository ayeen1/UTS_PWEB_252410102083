{{--
    Kartu mata kuliah di papan Jadwal & Tugas.
    Dipanggil di pengelolaan.blade.php: <x-kartu-matkul :item="$item" :urutan="$loop->index" />
    $item berisi satu baris array jadwal dari PageController.
--}}
@props(['item', 'urutan' => 0])

@php($selesai = $item['status'] === 'Selesai')

<article class="kartu kartu-matkul muncul p-4"
         style="--i: {{ $urutan }}; --warna-hari: {{ $item['warna'] }}"
         data-tugas-id="{{ $item['id'] }}"
         data-cari="{{ strtolower($item['matkul'].' '.$item['tugas']) }}">
    <div class="flex items-center justify-between gap-2">
        {{-- pill jam berwarna hari (solid) --}}
        <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-semibold text-white tabular-nums"
              style="background: {{ $item['warna'] }}">
            <x-ikon nama="jam" class="h-3.5 w-3.5" />
            {{ $item['jam_mulai'] }}–{{ $item['jam_selesai'] }}
        </span>
        <span class="whitespace-nowrap text-xs text-teks-2">Kelas {{ $item['kelas'] }}</span>
    </div>

    <h3 class="mt-3 font-judul text-[15px] font-semibold leading-snug text-teks">{{ $item['matkul'] }}</h3>
    <span class="mt-2 block h-[3px] w-7 rounded-full" style="background: {{ $item['warna'] }}"></span>

    <hr class="my-3 border-garis">

    <p class="text-[11px] font-semibold uppercase tracking-wider text-teks-2">Tugas</p>
    <p class="judul-tugas mt-1 text-sm text-teks {{ $selesai ? 'is-selesai' : '' }}">{{ $item['tugas'] }}</p>

    <div class="mt-3 flex items-center justify-between gap-2">
        <span class="inline-flex items-center gap-1.5 whitespace-nowrap text-xs text-teks-2 tabular-nums">
            <x-ikon nama="kalender" class="h-3.5 w-3.5" /> {{ $item['deadline_teks'] }}
        </span>
        {{-- chip status: bisa diklik, diatur oleh app.js --}}
        <button type="button" class="chip-status {{ $selesai ? 'is-selesai' : 'is-belum' }}"
                data-id="{{ $item['id'] }}" aria-pressed="{{ $selesai ? 'true' : 'false' }}"
                aria-label="Ubah status tugas {{ $item['tugas'] }}">
            <span class="chip-ikon" aria-hidden="true"></span>
            <span class="chip-teks">{{ $item['status'] }}</span>
        </button>
    </div>
</article>
