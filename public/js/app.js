/* =====================================================================
   KULIYAAH - JavaScript vanilla (materi DOM & event listener)
   Semua yang dilakukan di sini HANYA mengubah tampilan di browser.
   Tidak ada data yang dikirim atau disimpan (aplikasi tanpa database).
   ===================================================================== */

// Kalau pengguna minta gerakan dikurangi, animasi JS juga dimatikan.
const kurangiGerak = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/* ---------------------------------------------------------------------
   Halaman Jadwal & Tugas: klik chip status Belum <-> Selesai
   Ini HANYA mengubah tampilan (DOM). Tidak ada data yang disimpan,
   jadi saat halaman dimuat ulang status kembali sesuai array di controller.
   --------------------------------------------------------------------- */
function animasiUlang(el, namaKelas) {
    if (kurangiGerak) return;
    el.classList.remove(namaKelas);
    void el.offsetWidth; // paksa reflow supaya animasi bisa diulang
    el.classList.add(namaKelas);
}

/* Hitung ulang chip "Selesai" dan "Belum" di atas papan dari kartu yang ada */
function perbaruiAngka() {
    const selesai = document.querySelectorAll('.chip-status.is-selesai').length;
    const belum = document.querySelectorAll('.chip-status.is-belum').length;
    const hasil = { selesai, belum };

    document.querySelectorAll('[data-hitung]').forEach((el) => {
        const nilaiBaru = hasil[el.dataset.hitung];
        if (String(nilaiBaru) !== el.textContent.trim()) {
            el.textContent = nilaiBaru;
            animasiUlang(el, 'angka-lompat');
        }
    });
}

function siapkanPapanStatus() {
    document.querySelectorAll('.chip-status').forEach((chip) => {
        chip.addEventListener('click', () => {
            const judul = chip.closest('.kartu-matkul').querySelector('.judul-tugas');
            const jadiSelesai = chip.classList.contains('is-belum');

            chip.classList.toggle('is-selesai', jadiSelesai);
            chip.classList.toggle('is-belum', !jadiSelesai);
            chip.setAttribute('aria-pressed', String(jadiSelesai));
            chip.querySelector('.chip-teks').textContent = jadiSelesai ? 'Selesai' : 'Belum';
            judul.classList.toggle('is-selesai', jadiSelesai); // coret / tidak dicoret

            animasiUlang(chip, 'chip-pop');
            perbaruiAngka();
        });
    });
}

/* ---------------------------------------------------------------------
   Pencarian kartu (Jadwal & Tugas)
   --------------------------------------------------------------------- */
function siapkanPencarian() {
    const input = document.getElementById('cari');
    if (!input) return;
    const kartuSemua = document.querySelectorAll('.kartu-matkul');
    const pesanKosong = document.getElementById('cari-kosong');

    input.addEventListener('input', () => {
        const kata = input.value.trim().toLowerCase();
        let jumlahCocok = 0;

        kartuSemua.forEach((kartu) => {
            const cocok = kata === '' || kartu.dataset.cari.includes(kata);
            if (cocok) {
                jumlahCocok++;
                if (kartu.hidden) {
                    kartu.hidden = false;
                    void kartu.offsetWidth;
                }
                kartu.classList.remove('is-menghilang');
            } else if (!kartu.hidden && !kartu.classList.contains('is-menghilang')) {
                // mengecil dulu, baru disembunyikan setelah transisi selesai
                kartu.classList.add('is-menghilang');
                setTimeout(() => {
                    if (kartu.classList.contains('is-menghilang')) kartu.hidden = true;
                }, kurangiGerak ? 0 : 220);
            }
        });

        pesanKosong.classList.toggle('hidden', jumlahCocok > 0);
    });
}

/* ---------------------------------------------------------------------
   Papan geser di mobile: tab hari + indikator titik
   --------------------------------------------------------------------- */
function siapkanPapanGeser() {
    const papan = document.getElementById('papan');
    if (!papan) return;
    const kolom = papan.querySelectorAll('.kolom-hari');
    const tab = document.querySelectorAll('.tab-hari');
    const titik = document.querySelectorAll('.titik-indikator');
    const modeMobile = () => window.matchMedia('(max-width: 767px)').matches;

    function tandaiAktif(index) {
        tab.forEach((t, i) => t.classList.toggle('is-aktif', i === index));
        titik.forEach((t, i) => t.classList.toggle('is-aktif', i === index));
    }

    function geserKe(index, halus) {
        const tujuan = kolom[index];
        if (!tujuan) return;
        papan.scrollTo({
            left: tujuan.offsetLeft - papan.offsetLeft - 16,
            behavior: halus && !kurangiGerak ? 'smooth' : 'auto',
        });
        tandaiAktif(index);
    }

    // Klik tab -> papan bergeser ke kolom hari itu
    tab.forEach((t) => {
        t.addEventListener('click', () => geserKe(Number(t.dataset.index), true));
    });

    // Saat digeser manual, cari kolom yang paling dekat lalu tandai aktif
    let jeda;
    papan.addEventListener('scroll', () => {
        clearTimeout(jeda);
        jeda = setTimeout(() => {
            const lebar = kolom[0].offsetWidth + 12;
            tandaiAktif(Math.round(papan.scrollLeft / lebar));
        }, 60);
    });

    // Saat halaman dibuka: langsung ke kolom hari ini
    const indexHariIni = Number(papan.dataset.hariIni || 0);
    if (modeMobile()) geserKe(indexHariIni, false);
    tandaiAktif(indexHariIni);
}

/* ---------------------------------------------------------------------
   Dashboard: angka ringkasan menghitung naik dari 0
   --------------------------------------------------------------------- */
function jalankanCountUp() {
    document.querySelectorAll('[data-countup]').forEach((el) => {
        const target = Number(el.dataset.countup);
        if (kurangiGerak || target === 0) {
            el.textContent = target;
            return;
        }
        const durasi = 900;
        const mulai = performance.now();
        function langkah(sekarang) {
            const t = Math.min((sekarang - mulai) / durasi, 1);
            const halus = 1 - Math.pow(1 - t, 3); // ease-out
            el.textContent = Math.round(target * halus);
            if (t < 1) requestAnimationFrame(langkah);
        }
        el.textContent = 0;
        requestAnimationFrame(langkah);
    });
}

/* ---------------------------------------------------------------------
   Profil: bar terisi dari 0 ke nilai sebenarnya
   --------------------------------------------------------------------- */
function isiBar() {
    const bar = document.querySelectorAll('.bar-isi');
    if (bar.length === 0) return;
    // tunggu 2 frame supaya lebar 0 sempat digambar, lalu transisi ke nilai asli
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            bar.forEach((b) => { b.style.width = `${b.dataset.isi}%`; });
        });
    });
}

/* ---------------------------------------------------------------------
   Login: tombol Tampilkan / Sembunyikan password
   --------------------------------------------------------------------- */
function siapkanTombolPassword() {
    const tombol = document.getElementById('tombol-password');
    if (!tombol) return;
    const input = document.getElementById('password');

    tombol.addEventListener('click', () => {
        const terlihat = input.type === 'text';
        input.type = terlihat ? 'password' : 'text';
        tombol.textContent = terlihat ? 'Tampilkan' : 'Sembunyikan';
        tombol.setAttribute('aria-pressed', String(!terlihat));
        input.focus();
    });
}

/* ---------------------------------------------------------------------
   Menu hamburger (mobile): panel meluncur dari kanan
   --------------------------------------------------------------------- */
function siapkanMenu() {
    const tombolBuka = document.getElementById('tombol-menu');
    if (!tombolBuka) return;
    const tombolTutup = document.getElementById('tutup-menu');
    const panel = document.getElementById('panel-menu');
    const latar = document.getElementById('latar-menu');

    function buka() {
        panel.hidden = false;
        latar.hidden = false;
        void panel.offsetWidth; // reflow supaya transisi jalan
        document.body.classList.add('menu-terbuka');
        tombolBuka.setAttribute('aria-expanded', 'true');
        tombolTutup.focus();
    }

    function tutup() {
        document.body.classList.remove('menu-terbuka');
        tombolBuka.setAttribute('aria-expanded', 'false');
        setTimeout(() => {
            panel.hidden = true;
            latar.hidden = true;
        }, kurangiGerak ? 0 : 280);
        tombolBuka.focus();
    }

    tombolBuka.addEventListener('click', buka);
    tombolTutup.addEventListener('click', tutup);
    latar.addEventListener('click', tutup); // klik di luar panel
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && document.body.classList.contains('menu-terbuka')) tutup();
    });
}

/* ---------------------------------------------------------------------
   Jalankan semua setelah HTML selesai dimuat
   --------------------------------------------------------------------- */
document.addEventListener('DOMContentLoaded', () => {
    jalankanCountUp();
    isiBar();
    siapkanPapanStatus();
    siapkanPencarian();
    siapkanPapanGeser();
    siapkanTombolPassword();
    siapkanMenu();
});
