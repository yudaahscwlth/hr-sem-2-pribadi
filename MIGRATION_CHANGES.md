# Perubahan File Migrations

File migrations telah diperbaiki agar sesuai dengan struktur database di `db/dummyhr.sql`.

## File Migration yang Dibuat Baru

### 1. `2025_06_01_000001_create_departemen_table.php`
Membuat tabel `departemen` dengan struktur:
- `id_departemen` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `nama_departemen` (VARCHAR 255)
- `kepala_departemen` (INT, NULLABLE)

### 2. `2025_06_01_000002_create_jabatan_table.php`
Membuat tabel `jabatan` dengan struktur:
- `id_jabatan` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `nama_jabatan` (VARCHAR 255)

### 3. `2025_06_01_000003_create_pegawai_table.php`
Membuat tabel `pegawai` dengan struktur lengkap:
- `id_pegawai` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `nama`, `tempat_lahir`, `tanggal_lahir`
- `jenis_kelamin` (ENUM: 'L', 'P')
- `alamat`, `status` (ENUM: 'Aktif', 'Nonaktif', 'Cuti')
- `no_hp`, `email`
- `id_jabatan`, `id_departemen` (FOREIGN KEYS)
- `tanggal_masuk`, `foto`
- `jatahtahunan` (INT, default 0)

### 4. `2025_06_01_000004_create_kehadiran_table.php`
Membuat tabel `kehadiran` dengan struktur:
- `id_kehadiran` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `id_pegawai` (FOREIGN KEY ke pegawai)
- `tanggal`, `lokasi_kantor_id`
- `waktu_masuk`, `waktu_pulang`
- `total_jam_kerja`, `durasi_kerja`
- `status_jam_kerja` (ENUM: 'Memenuhi', 'Kurang', 'Setengah Hari')
- `status_kehadiran` (ENUM: 'Hadir', 'Tidak Hadir', 'Terlambat', 'Sakit', 'Izin')
- `created_at`, `updated_at`

### 5. `2025_06_01_000005_add_foreign_keys_to_user.php`
Menambahkan foreign key constraint ke tabel `user`:
- Foreign key `id_pegawai` yang merujuk ke `pegawai.id_pegawai`
- Migration ini terpisah karena harus dijalankan setelah tabel pegawai dibuat

## File Migration yang Diperbaiki

### 1. `0001_01_01_000000_create_users_table.php`
**Perubahan:**
- Mengubah `id_user` dari BIGINT ke INT
- Mengubah `role` dari STRING ke ENUM('pegawai', 'hrd', 'kepala_yayasan')
- Mengubah `id_pegawai` dari unsignedBigInteger ke integer dengan NULLABLE
- Menambahkan indexes untuk performa
- **CATATAN**: Foreign key ke tabel pegawai dipindahkan ke migration terpisah (`2025_06_01_000005_add_foreign_keys_to_user.php`) untuk menghindari dependency error

### 2. `2025_06_10_071221_create_lokasi_kantor_table.php`
**Perubahan:**
- Menambahkan kolom `status` (ENUM: 'aktif', 'nonaktif')
- Menambahkan index untuk kolom status
- Menyesuaikan tipe data `id` menjadi unsigned integer

### 3. `2025_07_01_133644_cuti.php`
**Perubahan:**
- Menambahkan kolom `disetujui_oleh` (INT, NULLABLE)
- Menambahkan index untuk kolom `disetujui_oleh`

### 4. `2025_06_22_125832_create_penilaian_table.php`
**Perubahan:**
- Memperbaiki foreign key `periode_id` agar merujuk ke `periode_penilaian` (bukan `periode_kuisioner`)
- Menambahkan kolom `total_nilai` (INT, default 0)
- Menambahkan indexes untuk semua foreign keys dan status

## File Migration yang Dihapus

File-file berikut dihapus karena sudah tidak diperlukan atau duplikat:

1. **`2025_06_11_062348_add_golongan_to_pegawai_table.php`**
   - Alasan: Kolom `golongan` tidak ada di database SQL

2. **`2025_06_22_121755_add_jam_kerja_to_kehadiran_table.php`**
   - Alasan: Kolom-kolom ini sudah termasuk dalam migration `create_kehadiran_table`

3. **`2025_06_30_145048_update_penilaian_table_to_pegawai_id.php`**
   - Alasan: Perbaikan foreign key sudah termasuk dalam migration `create_penilaian_table` yang telah diperbaiki

## File Migration yang Tidak Berubah

File-file berikut tetap seperti semula karena sudah sesuai:

1. `0001_01_01_000001_create_cache_table.php`
2. `0001_01_01_000002_create_jobs_table.php`
3. `2025_06_22_125152_create_periode_penilaian_table.php`
4. `2025_06_22_130406_create_kuisioner.php`
5. `2025_06_22_130512_create_periode_kuisioner.php`
6. `2025_06_22_130916_create_jawaban_kuisioner.php`
7. `2025_07_01_133938_jenis_cuti.php`
8. `2025_07_07_193706_create_sessions_table.php`
9. `2025_07_08_154014_create_log_activity_table.php`
10. `2025_07_08_154947_create_all_trigger.php`

## Urutan Eksekusi Migration

Migration akan dijalankan dalam urutan berikut (berdasarkan nama file):

1. `0001_01_01_000000_create_users_table.php` - Tabel user
2. `0001_01_01_000001_create_cache_table.php` - Tabel cache
3. `0001_01_01_000002_create_jobs_table.php` - Tabel jobs
4. `2025_06_01_000001_create_departemen_table.php` - ⭐ Tabel departemen
5. `2025_06_01_000002_create_jabatan_table.php` - ⭐ Tabel jabatan
6. `2025_06_01_000003_create_pegawai_table.php` - ⭐ Tabel pegawai
7. `2025_06_01_000004_create_kehadiran_table.php` - ⭐ Tabel kehadiran
8. `2025_06_10_071221_create_lokasi_kantor_table.php` - Tabel lokasi_kantor
9. `2025_06_22_125152_create_periode_penilaian_table.php` - Tabel periode_penilaian
10. `2025_06_22_125832_create_penilaian_table.php` - Tabel penilaian
11. `2025_06_22_130406_create_kuisioner.php` - Tabel kuisioner
12. `2025_06_22_130512_create_periode_kuisioner.php` - Tabel periode_kuisioner
13. `2025_06_22_130916_create_jawaban_kuisioner.php` - Tabel jawaban_kuisioner
14. `2025_07_01_133644_cuti.php` - Tabel cuti
15. `2025_07_01_133938_jenis_cuti.php` - Tabel jenis_cuti
16. `2025_07_07_193706_create_sessions_table.php` - Tabel sessions
17. `2025_07_08_154014_create_log_activity_table.php` - Tabel log_activity
18. `2025_07_08_154947_create_all_trigger.php` - Database triggers

⭐ = File migration baru

## Catatan Penting

1. **Foreign Key Dependencies**: Urutan migration sangat penting karena foreign key constraints. Tabel parent harus dibuat sebelum tabel child.

2. **Data Existing**: Jika database sudah ada dengan data, sebaiknya gunakan file SQL untuk import langsung daripada menjalankan migrations, karena:
   - Migrations akan membuat tabel kosong
   - File SQL sudah berisi data lengkap
   - Struktur di SQL file sudah teruji

3. **Fresh Install**: Migration ini cocok untuk fresh installation atau development environment baru.

## Cara Menggunakan

### Untuk Fresh Installation:
```bash
php artisan migrate:fresh
```

### Untuk Import Data dari SQL File:
```bash
# Import menggunakan mysql client
mysql -u username -p database_name < db/dummyhr.sql

# Atau untuk Railway/remote database:
mysql -h host -u username -p -P port database_name < db/dummyhr.sql
```

### Reset dan Migrasi Ulang:
```bash
php artisan migrate:fresh --seed
```

