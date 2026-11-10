{{--
    Kartu ringkasan di Dashboard. Dipanggil dengan:
    @include('partials.kartu-ringkasan', ['ikon' => ..., 'label' => ..., 'angka' => ..., 'keterangan' => ..., 'urutan' => ...])
--}}
<article class="kartu muncul flex items-center gap-4 p-5 sm:p-6" style="--i: {{ $urutan }}">
    <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-latar text-teks">
        <x-ikon :nama="$ikon" class="h-6 w-6" />
    </span>
    <div class="min-w-0">
        <p class="text-sm text-teks-2">{{ $label }}</p>
        <p class="font-judul text-3xl font-bold leading-tight tabular-nums"
           data-countup="{{ $angka }}">{{ $angka }}</p>
        <p class="text-xs text-teks-2">{{ $keterangan }}</p>
    </div>
</article>
