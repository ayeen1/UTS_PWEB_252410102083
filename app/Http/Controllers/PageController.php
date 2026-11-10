<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    private function dataAkun(): array
    {
        return [
            'username' => 'Ren',
            'password' => 'Naren1234',
        ];
    }

    private function dataProfil(): array
    {
        return [
            'nama_lengkap' => 'Narendra Wisnu Mahaputra',
            'nim' => '252410102083',
            'prodi' => 'Teknologi Informasi',
            'peran' => 'Mahasiswa',
        ];
    }

    private function dataJadwal(): array
    {
        return [
            ['id' => 1, 'hari' => 'Senin', 'jam_mulai' => '09:40', 'jam_selesai' => '11:30', 'matkul' => 'UI/UX Desain', 'kelas' => 'A', 'tugas' => 'Prototype Hi-Fi BudgetFriendly', 'deadline' => '2026-11-14', 'status' => 'Belum'],
            ['id' => 2, 'hari' => 'Senin', 'jam_mulai' => '11:30', 'jam_selesai' => '13:20', 'matkul' => 'Pemrograman Berbasis Web', 'kelas' => 'C', 'tugas' => 'UTS: Web App KULIYAAH', 'deadline' => '2026-11-12', 'status' => 'Belum'],
            ['id' => 3, 'hari' => 'Senin', 'jam_mulai' => '14:20', 'jam_selesai' => '16:00', 'matkul' => 'Pertanian Industrial Berkelanjutan', 'kelas' => '14', 'tugas' => 'Solusi Dilema Lindi TPA Pakusari', 'deadline' => '2026-10-06', 'status' => 'Selesai'],
            ['id' => 4, 'hari' => 'Selasa', 'jam_mulai' => '08:50', 'jam_selesai' => '10:30', 'matkul' => 'Dasar-dasar Keamanan Informasi', 'kelas' => 'B', 'tugas' => 'Kuis CIA Triad', 'deadline' => '2026-11-03', 'status' => 'Selesai'],
            ['id' => 5, 'hari' => 'Selasa', 'jam_mulai' => '10:40', 'jam_selesai' => '12:20', 'matkul' => 'Administrasi Sistem', 'kelas' => 'A', 'tugas' => 'Video Praktikum ATS Linux', 'deadline' => '2026-11-13', 'status' => 'Belum'],
            ['id' => 6, 'hari' => 'Rabu', 'jam_mulai' => '08:50', 'jam_selesai' => '10:30', 'matkul' => 'Tata Kelola Teknologi Informasi', 'kelas' => 'F', 'tugas' => 'Studi Kasus COBIT 2019', 'deadline' => '2026-11-18', 'status' => 'Belum'],
            ['id' => 7, 'hari' => 'Rabu', 'jam_mulai' => '10:40', 'jam_selesai' => '12:20', 'matkul' => 'Bahasa Inggris', 'kelas' => 'F', 'tugas' => 'Vocabulary Guessing Game (UTS)', 'deadline' => '2026-10-15', 'status' => 'Selesai'],
            ['id' => 8, 'hari' => 'Rabu', 'jam_mulai' => '16:10', 'jam_selesai' => '17:50', 'matkul' => 'Manajemen dan Kewirausahaan', 'kelas' => 'A', 'tugas' => 'Pitch Deck Le Cheese', 'deadline' => '2026-10-27', 'status' => 'Selesai'],
            ['id' => 9, 'hari' => 'Kamis', 'jam_mulai' => '07:00', 'jam_selesai' => '08:40', 'matkul' => 'Pengantar Kecerdasan Buatan', 'kelas' => 'E', 'tugas' => 'Resume Algoritma Pencarian', 'deadline' => '2026-11-20', 'status' => 'Belum'],
            ['id' => 10, 'hari' => 'Kamis', 'jam_mulai' => '08:50', 'jam_selesai' => '10:30', 'matkul' => 'Embedded System Programming', 'kelas' => 'B', 'tugas' => 'Proposal Proyek Akhir', 'deadline' => '2026-11-17', 'status' => 'Belum'],
            ['id' => 11, 'hari' => 'Kamis', 'jam_mulai' => '12:30', 'jam_selesai' => '14:10', 'matkul' => 'Pendidikan Agama Islam', 'kelas' => '46', 'tugas' => 'Tugas Akhir PjBL: Peran Masjid', 'deadline' => '2026-11-24', 'status' => 'Belum'],
            ['id' => 12, 'hari' => 'Jumat', 'jam_mulai' => '07:00', 'jam_selesai' => '09:40', 'matkul' => 'UI/UX Desain', 'kelas' => 'A', 'tugas' => 'Laporan Usability Testing', 'deadline' => '2026-11-21', 'status' => 'Belum'],
            ['id' => 13, 'hari' => 'Jumat', 'jam_mulai' => '12:30', 'jam_selesai' => '15:10', 'matkul' => 'Pemrograman Berbasis Web', 'kelas' => 'C', 'tugas' => 'Praktikum Blade & Routing', 'deadline' => '2026-11-07', 'status' => 'Selesai'],
        ];
    }

    private function warnaHari(): array
    {
        return [
            'Senin' => '#2563EB',
            'Selasa' => '#EA580C',
            'Rabu' => '#0F766E',
            'Kamis' => '#CA8A04',
            'Jumat' => '#DB2777',
        ];
    }

    public function loginForm(): View
    {
        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|alpha_dash|max:50',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.alpha_dash' => 'Username hanya boleh huruf, angka, - dan _.',
            'username.max' => 'Username maksimal 50 karakter.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $akun = $this->dataAkun();

        $usernameCocok = strtolower($request->input('username')) === strtolower($akun['username']);
        $passwordCocok = $request->input('password') === $akun['password'];
        if (! $usernameCocok || ! $passwordCocok) {
            return redirect()->route('login')->with('gagal', 'Username atau password salah.');
        }

        return redirect()->route('dashboard', ['username' => $akun['username']]);
    }

    public function dashboard(Request $request): View|RedirectResponse
    {
        $username = $request->query('username');
        if (! $this->usernameValid($username)) {
            return redirect()->route('login');
        }

        $jadwal = $this->jadwalLengkap();
        $hariIni = $this->namaHariIni();
        $jamSekarang = now()->format('H:i');

        $kelasHariIni = collect($jadwal)->where('hari', $hariIni)->sortBy('jam_mulai')->values()->all();
        $idBerikutnya = collect($kelasHariIni)->first(fn ($k) => $k['jam_mulai'] > $jamSekarang)['id'] ?? null;
        $semuaKelasLewat = count($kelasHariIni) > 0 && $idBerikutnya === null;

        $deadlineTerdekat = collect($jadwal)
            ->where('status', 'Belum')
            ->sortBy('deadline')
            ->take(5)
            ->values()
            ->all();

        $tugasMingguIni = collect($jadwal)
            ->where('status', 'Belum')
            ->filter(fn ($t) => $t['sisa_angka'] >= 0 && $t['sisa_angka'] <= 7)
            ->count();

        return view('dashboard', [
            'username' => $username,
            'active' => 'dashboard',
            'judul' => 'Dashboard',
            'tanggalHariIni' => $this->tanggalHariIni(),
            'kelasHariIni' => $kelasHariIni,
            'idBerikutnya' => $idBerikutnya,
            'semuaKelasLewat' => $semuaKelasLewat,
            'deadlineTerdekat' => $deadlineTerdekat,
            'tugasMingguIni' => $tugasMingguIni,
            'ringkasan' => $this->ringkasan($jadwal),
            'adaFoto' => $this->adaFoto(),
        ]);
    }

    public function pengelolaan(Request $request): View|RedirectResponse
    {
        $username = $request->query('username');
        if (! $this->usernameValid($username)) {
            return redirect()->route('login');
        }

        $jadwal = $this->jadwalLengkap();

        $jadwalPerHari = collect($jadwal)->groupBy('hari');

        $senin = now()->startOfWeek(Carbon::MONDAY);
        $jumat = $senin->copy()->addDays(4);
        $rentangMinggu = $senin->format('j').' – '.$jumat->locale('id')->translatedFormat('j F Y');

        $daftarHari = array_keys($this->warnaHari());
        $indexHariIni = array_search($this->namaHariIni(), $daftarHari);

        return view('pengelolaan', [
            'username' => $username,
            'active' => 'pengelolaan',
            'judul' => 'Jadwal & Tugas',
            'hariIni' => $this->namaHariIni(),
            'indexHariIni' => $indexHariIni === false ? 0 : $indexHariIni,
            'daftarHari' => $daftarHari,
            'warnaHari' => $this->warnaHari(),
            'jadwalPerHari' => $jadwalPerHari,
            'rentangMinggu' => $rentangMinggu,
            'ringkasan' => $this->ringkasan($jadwal),
            'adaFoto' => $this->adaFoto(),
        ]);
    }

    public function profile(Request $request): View|RedirectResponse
    {
        $username = $request->query('username');
        if (! $this->usernameValid($username)) {
            return redirect()->route('login');
        }

        $jadwal = $this->jadwalLengkap();
        $ringkasan = $this->ringkasan($jadwal);

        $jumlahPerHari = collect($jadwal)->countBy('hari');
        $terbanyak = $jumlahPerHari->max();
        $kelasPerHari = [];
        foreach (array_keys($this->warnaHari()) as $hari) {
            $jumlah = $jumlahPerHari[$hari] ?? 0;
            $kelasPerHari[] = [
                'hari' => $hari,
                'jumlah' => $jumlah,
                'persen' => $terbanyak > 0 ? round($jumlah / $terbanyak * 100) : 0,
            ];
        }

        return view('profile', [
            'username' => $username,
            'active' => 'profile',
            'judul' => 'Profil',
            'profil' => $this->dataProfil(),
            'ringkasan' => $ringkasan,
            'kelasPerHari' => $kelasPerHari,
            'adaFoto' => $this->adaFoto(),
        ]);
    }

    private function jadwalLengkap(): array
    {
        $hasil = [];
        foreach ($this->dataJadwal() as $item) {
            $deadline = Carbon::parse($item['deadline'])->locale('id');
            $sisa = (int) now()->startOfDay()->diffInDays($deadline->copy()->startOfDay(), false);

            $item['deadline_teks'] = $deadline->translatedFormat('d M Y');
            $item['deadline_pendek'] = $deadline->translatedFormat('j M');
            $item['sisa_angka'] = $sisa;
            $item['sisa_teks'] = $this->teksSisaHari($sisa);
            $item['warna'] = $this->warnaHari()[$item['hari']];
            $hasil[] = $item;
        }

        return $hasil;
    }

    private function teksSisaHari(int $sisa): string
    {
        if ($sisa < 0) {
            return 'Terlambat';
        }
        if ($sisa === 0) {
            return 'Hari ini';
        }
        if ($sisa === 1) {
            return 'Besok';
        }

        return $sisa.' hari lagi';
    }

    private function ringkasan(array $jadwal): array
    {
        $koleksi = collect($jadwal);
        $hariIni = $this->namaHariIni();
        $kelasHariIni = $koleksi->where('hari', $hariIni)->sortBy('jam_mulai');

        return [
            'total_matkul' => $koleksi->pluck('matkul')->unique()->count(),
            'total_tugas' => $koleksi->count(),
            'selesai' => $koleksi->where('status', 'Selesai')->count(),
            'belum' => $koleksi->where('status', 'Belum')->count(),
            'persen_selesai' => round($koleksi->where('status', 'Selesai')->count() / max($koleksi->count(), 1) * 100),
            'kelas_hari_ini' => $kelasHariIni->count(),
            'kelas_pertama' => $kelasHariIni->first()['jam_mulai'] ?? null,
        ];
    }

    private function usernameValid(?string $username): bool
    {
        return ! empty($username) && strtolower($username) === strtolower($this->dataAkun()['username']);
    }

    private function adaFoto(): bool
    {
        return file_exists(public_path('images/foto-profil.jpg'));
    }

    private function namaHariIni(): string
    {
        return ucfirst(now()->locale('id')->dayName);
    }

    private function tanggalHariIni(): string
    {
        return now()->locale('id')->translatedFormat('l, j F Y');
    }
}
