<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- @yield('title') diisi oleh tiap halaman lewat @section('title', '...') --}}
    <title>@yield('title', 'Masuk') · KULIYAAH</title>

    {{-- Font: Poppins untuk judul & logo, Inter untuk teks --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS via CDN (Metode A di materi), versi dikunci --}}
    <script src="https://unpkg.com/@tailwindcss/browser@4.1.11"></script>

    {{-- Warna & font KULIYAAH didaftarkan sebagai tema Tailwind, jadi bisa dipakai: bg-navy, text-aksen, dst. --}}
    <style type="text/tailwindcss">
        @theme {
            --color-navy: #1E3A8A;
            --color-navy-tua: #172E6E;
            --color-aksen: #F59E0B;
            --color-latar: #F5F7FA;
            --color-teks: #0F172A;
            --color-teks-2: #475569;
            --color-papan: #E5E9F0;
            --color-garis: #E2E8F0;
            --color-selesai: #16A34A;
            --color-belum: #DC2626;
            --color-biru-muda: #EFF6FF;
            --font-sans: "Inter", ui-sans-serif, system-ui, sans-serif;
            --font-judul: "Poppins", "Inter", ui-sans-serif, sans-serif;
        }
    </style>

    {{-- CSS buatan sendiri (animasi), dipanggil dengan helper asset() dari folder public --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="min-h-screen flex flex-col bg-latar text-teks font-sans antialiased @yield('body_class')">

    {{-- Navbar hanya muncul kalau sudah login (ada $username dari controller) --}}
    @isset($username)
        {{-- x-component: memanggil resources/views/components/navbar.blade.php sambil mengirim props --}}
        <x-navbar :username="$username" :active="$active ?? ''" :ada-foto="$adaFoto ?? false" />
    @endisset

    {{-- @yield('content') = tempat isi tiap halaman (@section('content') ... @endsection) --}}
    <main class="flex-1 halaman">
        @yield('content')
    </main>

    @isset($username)
        <x-footer />
    @endisset

    {{-- JavaScript vanilla buatan sendiri --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
