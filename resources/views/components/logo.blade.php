{{--
    Komponen logo KULIYAAH (SVG inline).
    Props:
      - ukuran : lebar/tinggi ikon dalam px
      - teks   : tampilkan tulisan "KULIYAAH" atau tidak
      - terang : true kalau logo ditaruh di atas latar navy (tulisan "KULI" jadi putih)
--}}
@props(['ukuran' => 40, 'teks' => true, 'terang' => false])

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5']) }}>
    <svg width="{{ $ukuran }}" height="{{ $ukuran }}" viewBox="0 0 48 48" aria-hidden="true">
        {{-- kotak navy --}}
        <rect width="48" height="48" rx="11" fill="#1E3A8A"/>
        {{-- buku terbuka: halaman kiri putih, kanan biru muda --}}
        <path d="M24 17.5C20.2 15 15.6 14.4 11 15.4V33.6C15.6 32.6 20.2 33.2 24 35.8Z" fill="#FFFFFF"/>
        <path d="M24 17.5C27.8 15 32.4 14.4 37 15.4V33.6C32.4 32.6 27.8 33.2 24 35.8Z" fill="#BFDBFE"/>
        {{-- lencana amber berisi centang --}}
        <circle cx="36.5" cy="11.5" r="7" fill="#F59E0B" stroke="#1E3A8A" stroke-width="2"/>
        <path d="M33.4 11.6l2.1 2.1 3.9-4.2" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    @if ($teks)
        <span class="font-judul font-bold tracking-wide leading-none" style="font-size: {{ round($ukuran * 0.5) }}px">
            <span class="{{ $terang ? 'text-white' : 'text-navy' }}">KULI</span><span class="text-aksen">YAAH</span>
        </span>
    @endif
</span>
