<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Masuk') · KULIYAAH</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@tailwindcss/browser@4.1.11"></script>

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

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="min-h-screen flex flex-col bg-latar text-teks font-sans antialiased @yield('body_class')">

    @isset($username)
        <x-navbar :username="$username" :active="$active ?? ''" :ada-foto="$adaFoto ?? false" />
    @endisset

    <main class="flex-1 halaman">
        @yield('content')
    </main>

    @isset($username)
        <x-footer />
    @endisset

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
