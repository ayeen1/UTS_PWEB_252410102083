{{--
    Komponen ikon SVG garis. Contoh pakai: <x-ikon nama="kalender" class="w-4 h-4" />
    @props mendaftarkan atribut yang diterima komponen ini.
--}}
@props(['nama'])

<svg {{ $attributes->merge(['class' => 'w-4 h-4 shrink-0']) }} viewBox="0 0 24 24" fill="none" stroke="currentColor"
     stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @if ($nama === 'dashboard')
        <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>
    @elseif ($nama === 'kalender')
        <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
    @elseif ($nama === 'profil')
        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
    @elseif ($nama === 'jam')
        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
    @elseif ($nama === 'buku')
        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
    @elseif ($nama === 'clipboard')
        <rect x="8" y="2" width="8" height="4" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/>
    @elseif ($nama === 'alarm')
        <circle cx="12" cy="13" r="8"/><path d="M12 9v4l2 2M5 3 2 6M22 6l-3-3"/>
    @elseif ($nama === 'idcard')
        <rect x="2" y="5" width="20" height="14" rx="2"/><circle cx="8" cy="11" r="2"/><path d="M5 17a3 3 0 0 1 6 0M14 10h4M14 14h4"/>
    @elseif ($nama === 'cari')
        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
    @elseif ($nama === 'panah')
        <path d="M5 12h14M12 5l7 7-7 7"/>
    @elseif ($nama === 'centang')
        <path d="M20 6 9 17l-5-5"/>
    @elseif ($nama === 'gembok')
        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
    @elseif ($nama === 'menu')
        <path d="M4 6h16M4 12h16M4 18h16"/>
    @elseif ($nama === 'tutup')
        <path d="M18 6 6 18M6 6l12 12"/>
    @elseif ($nama === 'titik3')
        <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
    @elseif ($nama === 'keluar')
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
    @elseif ($nama === 'reset')
        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/>
    @endif
</svg>
