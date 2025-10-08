# Informasi Seeders - DummyHR

Semua seeder telah diperbaiki agar sesuai dengan data di `db/dummyhr.sql`.

## 📋 Daftar Seeders

### 1. **DepartemenSeeder** ✅
Membuat 3 departemen:
- ID 1: Teknologi Informasi
- ID 2: Keuangan  
- ID 3: Sumber Daya Manusia

### 2. **JabatanSeeder** ✅
Membuat 4 jabatan:
- ID 1: Staff
- ID 3: Kepala
- ID 4: Kepala Departemen
- ID 5: Kepala Yayasan

### 3. **JenisCutiSeeder** ✅
Membuat 5 jenis cuti:
- ID 1: Cuti Tahunan (12 hari)
- ID 2: Cuti Sakit (10 hari)
- ID 3: Cuti Melahirkan (90 hari)
- ID 4: Cuti Besar (30 hari)
- ID 5: Cuti Penting (5 hari)

### 4. **LokasiKantorSeeder** ✅
Membuat 5 lokasi kantor:
- ID 3: Kantor 1 (Batam)
- ID 4: Kantor 2 (Batam)
- ID 5: kantor deny (Batam)
- ID 6: poltek (Batam)
- ID 7: rafles (Batam)

### 5. **PegawaiUtamaSeeder** ⭐ BARU
Membuat 9 pegawai utama sesuai db/dummyhr.sql:
1. ID 1: Danu Pratamaa (Staff TI)
2. ID 2: Danu Yudistia (Staff SDM)
3. ID 3: asep (Kepala SDM)
4. ID 5: ellsa (Staff TI)
5. ID 6: Ahmad Yanii (Kepala Yayasan)
6. ID 17: Zahra Ghaliyati Pratiwi (Staff TI)
7. ID 18: Ibrahim Martana Hakim (Staff Keuangan)
8. ID 19: Betania Kusmawati (Staff TI)
9. ID 20: Darman Simbolon (Staff TI)

### 6. **UserUtamaSeeder** ⭐ BARU
Membuat 5 user account dengan kredensial jelas:

| Username | Password    | Role            | Pegawai           |
|----------|-------------|-----------------|-------------------|
| danu     | danu123     | pegawai         | Danu Pratamaa     |
| staff    | staff123    | hrd             | Danu Yudistia     |
| ellsa    | ellsa123    | pegawai         | ellsa             |
| ahmad    | ahmad123    | kepala_yayasan  | Ahmad Yanii       |
| kepala   | kepala123   | hrd             | ellsa             |

### 7. **PegawaiSeeder** (Opsional)
Generate 50 pegawai random dengan Faker.
**Status:** Dinonaktifkan by default di DatabaseSeeder

### 8. **UserSeeder** (Lama - Tidak Dipakai)
**Status:** Digantikan oleh UserUtamaSeeder

---

## 🚀 Cara Menggunakan

### Opsi 1: Run Semua Seeders
```bash
php artisan db:seed
```

### Opsi 2: Run Seeder Spesifik
```bash
php artisan db:seed --class=DepartemenSeeder
php artisan db:seed --class=JabatanSeeder
php artisan db:seed --class=PegawaiUtamaSeeder
php artisan db:seed --class=UserUtamaSeeder
```

### Opsi 3: Fresh Migration + Seed
```bash
php artisan migrate:fresh --seed
```

### Untuk Railway:
```bash
railway run php artisan migrate:fresh --seed --force
```

---

## 📝 Catatan Penting

### Password User
Semua password di **UserUtamaSeeder** sudah disederhanakan untuk kemudahan testing:
- Format: `{username}123`
- Contoh: username `danu` → password `danu123`

Jika ingin password yang sama dengan database original (hash yang sudah ada), Anda perlu:
1. Copy hash dari `db/dummyhr.sql`
2. Replace di UserUtamaSeeder dengan hash tersebut

### ID Pegawai & Lokasi
ID tidak sequential karena mengikuti data di `db/dummyhr.sql`:
- Pegawai: ID 1, 2, 3, 5, 6, 17, 18, 19, 20 (tidak ada ID 4)
- Lokasi Kantor: ID 3, 4, 5, 6, 7 (tidak ada ID 1, 2)

Ini normal dan sesuai dengan database production Anda.

### Foto Pegawai
Seeder menggunakan nama file foto dari database asli. Pastikan file-file ini ada di folder `public/uploads/pegawai/` atau gunakan foto default:
- `avatar-1.jpg`
- `user1.png`

---

## ⚙️ Konfigurasi di DatabaseSeeder.php

```php
$this->call([
    // Master Data
    DepartemenSeeder::class,      // ✅ Always run
    JabatanSeeder::class,          // ✅ Always run
    JenisCutiSeeder::class,        // ✅ Always run
    LokasiKantorSeeder::class,     // ✅ Always run
    
    // Core Data
    PegawaiUtamaSeeder::class,     // ✅ Always run
    UserUtamaSeeder::class,        // ✅ Always run
    
    // Optional - Uncomment jika diperlukan:
    // PegawaiSeeder::class,       // 50 pegawai random
    // KehadiranSeeder::class,     // Data kehadiran
    // KuisionerSeeder::class,     // Data kuisioner
    // PeriodePenilaianSeeder::class, // Periode penilaian
]);
```

---

## 🔄 Perbedaan dengan Database SQL Asli

| Aspek | Database SQL | Seeder |
|-------|--------------|--------|
| Data Departemen | ✅ Sama | ✅ Sama |
| Data Jabatan | ✅ Sama | ✅ Sama |
| Data Jenis Cuti | ✅ Sama | ✅ Sama |
| Data Lokasi Kantor | ✅ Sama | ✅ Sama |
| Data Pegawai | 50+ pegawai | 9 pegawai utama |
| Data User | 15+ users | 5 users utama |
| Password Hash | Hash asli | Hash baru (password jelas) |
| Data Kehadiran | Ada | Tidak di-seed (opsional) |
| Data Cuti | Ada | Tidak di-seed |
| Data Penilaian | Ada | Tidak di-seed |

---

## 🎯 Rekomendasi Penggunaan

### Untuk Development/Testing:
✅ **Gunakan Seeders** 
- Cepat setup database
- Password mudah diingat
- Bisa reset kapan saja dengan `migrate:fresh --seed`

### Untuk Production/Railway:
✅ **Import file SQL**
- Data lengkap dengan history
- Password original (sudah di-hash)
- Semua relasi data terjaga

---

## 📞 Login Credentials untuk Testing

Setelah run seeder, Anda bisa login dengan:

**Admin/HRD:**
- Username: `staff` | Password: `staff123`
- Username: `kepala` | Password: `kepala123`

**Kepala Yayasan:**
- Username: `ahmad` | Password: `ahmad123`

**Pegawai:**
- Username: `danu` | Password: `danu123`
- Username: `ellsa` | Password: `ellsa123`

---

## 🔧 Troubleshooting

### Error: "SQLSTATE[23000]: Integrity constraint violation"
**Penyebab:** ID sudah ada di database
**Solusi:** 
```bash
php artisan migrate:fresh --seed
```

### Error: "Call to undefined method insert()"
**Penyebab:** Typo di seeder
**Solusi:** Cek kembali syntax di seeder

### Password tidak bisa login
**Penyebab:** Hash password berbeda
**Solusi:** Gunakan password yang tertera di atas (format: username123)

---

## 📚 File Seeder Locations

```
database/seeders/
├── DatabaseSeeder.php         # Main seeder orchestrator
├── DepartemenSeeder.php       # ✅ Updated
├── JabatanSeeder.php          # ✅ Updated
├── JenisCutiSeeder.php        # ✅ OK
├── LokasiKantorSeeder.php     # ✅ Updated
├── PegawaiUtamaSeeder.php     # ⭐ NEW
├── UserUtamaSeeder.php        # ⭐ NEW
├── PegawaiSeeder.php          # Optional (random data)
└── UserSeeder.php             # Old (not used)
```

---

**Status:** ✅ Semua seeder sudah diperbaiki dan ready to use!

