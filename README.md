# Aplikasi Management Inventaris

Aplikasi Management Inventaris ini dibangun menggunakan **Laravel 11**. Aplikasi ini dirancang untuk memudahkan pengelolaan inventaris, termasuk manajemen pelanggan, karyawan, pemasok, dan transaksi.

## Fitur Utama

-   **Full Ajax**: Pengalaman pengguna yang lebih responsif dengan penggunaan Ajax.
-   **Datatable Server Side**: Pengelolaan data yang efisien dengan Datatable.
-   **Tiga Role Pengguna**:
    -   `super_admin`
    -   `admin`
    -   `staff`
-   **Dukungan untuk Mencetak Laporan**: Kemampuan untuk mencetak dokumen laporan.
-   **Ekspor ke PDF dan Excel**: Memudahkan pengguna untuk mengekspor data.
-   **Manajemen Pelanggan**: Fitur untuk mengelola data pelanggan.
-   **Manajemen Karyawan**: Fitur untuk mengelola data karyawan.
-   **Manajemen Pemasok**: Fitur untuk mengelola data pemasok.
-   **Manajemen Transaksi**: Pengelolaan transaksi barang masuk (GoodIn) dan barang keluar (GoodOut).

## Setup

Ikuti langkah-langkah berikut untuk mengatur aplikasi ini di lingkungan lokal Anda:

1. **Ubah Konfigurasi Database**: Sesuaikan konfigurasi database di file `.env`.
2. **Perbarui Dependensi**: Jalankan perintah berikut untuk memperbarui dependensi:
   bash composer update
3. **Migrasi Database**: Jalankan perintah berikut untuk melakukan migrasi dan mengisi data awal: `bash php artisan migrate --seed`
4. **Jalankan Server**: Jalankan perintah berikut untuk memulai server lokal: `php artisan serve`
5. **Buka Aplikasi**: Akses aplikasi di browser Anda melalui URL: `http://localhost:8000`
6. **Akun\*** bisa dieksplorasi di file `database/seeders/UserSeeder.php`

## Catatan

👾 **Bug**: Terdapat bug pada grafik transaksi. 😴

## Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan buat pull request atau buka isu untuk diskusi. Dan source code pada repo ini diambil dari `https://github.com/fiandev/Aplikasi-Management-Inventaris.git`

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
