# Status Proyek MyCourt

Berikut adalah daftar fitur yang **Sudah Jadi** dan **Belum Jadi** untuk mencapai 100% kelengkapan proyek.

## ✅ SUDAH JADI (Completed)

### 👤 User (Penyewa)
- [x] **Landing Page:** Halaman depan dengan desain modern.
- [x] **Daftar Lapangan:** Melihat semua lapangan (Futsal, Badminton) dengan harga dan detail.
- [x] **Form Booking:** Memilih tanggal, jam mulai, dan durasi.
- [x] **Cegah Booking Ganda:** Sistem menolak jika ada jadwal yang bentrok.

### 🏢 Manager (Pengelola)
- [x] **Dashboard:** Melihat statistik pendapatan hari ini dan booking pending.
- [x] **Data Booking:** Melihat tabel semua booking yang masuk.
- [x] **Verifikasi:** Tombol untuk **Approve** (Terima) atau **Reject** (Tolak) pesanan.

### 🛡️ Admin
- [x] **Dashboard:** Melihat total user, manager, dan lapangan.
- [x] **Kelola User:** Melihat daftar user terdaftar dan menghapus user.

### ⚙️ Sistem & Database
- [x] **Multi-Role Login:** Login otomatis diarahkan sesuai role (Admin/Manager/User).
- [x] **Tabel Database:** Users, Fields, Bookings, Schedules.
- [x] **Data Awal (Seeder):** Akun testing dan data lapangan dummy sudah siap.

---

## ❌ BELUM JADI (Pending)

Agar proyek ini dianggap **100% Sempurna (Full Features)**, fitur-fitur ini perlu ditambahkan:

### 1. Fitur User
- [ ] **Halaman Pembayaran:** Saat ini setelah booking langsung "Sukses". Seharusnya ada halaman upload bukti transfer atau integrasi Payment Gateway.
- [ ] **Riwayat Booking:** Halaman "Pesanan Saya" agar user bisa melihat status (apakah di-approve atau di-reject manager).

### 2. Fitur Manager
- [ ] **Blokir Jadwal Manual:** Fitur agar Manager bisa menutup lapangan (maintenance) di tanggal tertentu lewat tombol di dashboard.
- [ ] **Print Laporan:** Fitur untuk cetak laporan pendapatan ke PDF/Excel.

### 3. Fitur Admin
- [ ] **CRUD Lapangan:** Fitur untuk Tambah, Edit, dan Hapus data lapangan lewat website (saat ini data lapangan hanya dari database/coding).
- [ ] **Edit User:** Fitur untuk mengedit password atau data user lain.
