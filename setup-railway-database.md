# Cara Setup Database Railway yang Kosong

## Masalah: Tabel di Railway Kosong

Database Railway baru dibuat dan masih kosong. Berikut cara mengisinya:

---

## ✅ Opsi 1: Import File SQL (Paling Cepat - Ada Data Lengkap)

### Menggunakan MySQL Workbench (Recommended untuk Windows)

**Download & Install:**
- Download MySQL Workbench: https://dev.mysql.com/downloads/workbench/
- Install seperti biasa

**Steps:**

1. **Buka MySQL Workbench**

2. **Buat Connection Baru:**
   - Klik tombol "+" di samping "MySQL Connections"
   - Isi form:
     ```
     Connection Name: Railway DummyHR
     Hostname: [lihat di Railway → MySQL → Variables → MYSQLHOST]
     Port: [lihat di Railway → MySQL → Variables → MYSQLPORT]
     Username: [lihat di Railway → MySQL → Variables → MYSQLUSER]
     ```
   - Klik "Store in Keychain" untuk password
     - Masukkan: [lihat di Railway → MySQL → Variables → MYSQLPASSWORD]
   - Klik "Test Connection"
   - Jika sukses, klik "OK"

3. **Connect ke Database:**
   - Double-click connection "Railway DummyHR"
   - Akan terbuka query editor

4. **Import SQL File:**
   - Menu: **Server** → **Data Import**
   - Pilih: **"Import from Self-Contained File"**
   - Klik tombol **"..."** (Browse)
   - Pilih file: `D:\TesSem2\dummyhr\db\dummyhr.sql`
   - Di bagian **"Default Target Schema"**:
     - Pilih database Railway Anda (biasanya bernama `railway`)
   - Klik **"Start Import"**
   - Tunggu hingga selesai (akan muncul log "Import completed")

5. **Refresh & Verify:**
   - Klik menu **"Database"** → **"Refresh All"**
   - Lihat di panel kiri, sekarang ada tabel-tabel seperti:
     - pegawai
     - user
     - departemen
     - jabatan
     - kehadiran
     - cuti
     - dll

6. **Test Query:**
   ```sql
   SELECT * FROM user;
   SELECT * FROM pegawai LIMIT 10;
   ```
   Seharusnya sudah ada data!

---

## ✅ Opsi 2: Run Migrations (Database Kosong - Untuk Fresh Start)

Jika ingin database fresh tanpa data existing:

### Cara 1: Via Railway Dashboard (Mudah)

1. **Buka Railway Dashboard:**
   - Login ke railway.app
   - Pilih project DummyHR
   - Klik pada Laravel service (bukan MySQL)

2. **Buka Settings:**
   - Tab "Settings"
   - Scroll ke bawah ke bagian "Deploy"

3. **Trigger Manual Deploy dengan Migration:**
   - Pastikan Procfile sudah ada (cek file `Procfile` di project)
   - Deploy akan auto-run migrations

### Cara 2: Via Terminal Lokal (Butuh Setup)

**A. Install Railway CLI:**

Buka **Git Bash** (JANGAN PowerShell):
```bash
npm install -g @railway/cli
```

**B. Login & Link:**
```bash
railway login
# Browser akan terbuka, approve

railway link
# Pilih project DummyHR
```

**C. Run Migrations:**
```bash
railway run php artisan migrate --force
```

**D. Run Seeders (isi data awal):**
```bash
railway run php artisan db:seed --force
```

---

## ✅ Opsi 3: Copy Data dari Database Lokal

Jika sudah punya data di database lokal (XAMPP/Laragon):

### Export dari Lokal:

1. **Buka phpMyAdmin Lokal:**
   - http://localhost/phpmyadmin

2. **Export Database:**
   - Pilih database `dummyhr`
   - Tab "Export"
   - Format: SQL
   - Klik "Go"
   - Save file (misalnya `dummyhr_local.sql`)

3. **Import ke Railway:**
   - Gunakan MySQL Workbench seperti Opsi 1 di atas
   - Tapi pilih file export yang baru saja dibuat

---

## 🎯 Rekomendasi Berdasarkan Situasi

### Jika Anda:

**✅ Punya file `db/dummyhr.sql` dengan data lengkap:**
→ **Gunakan Opsi 1** (Import SQL via MySQL Workbench)
- Paling cepat
- Data langsung lengkap
- Tidak perlu setup CLI

**✅ Ingin fresh database kosong:**
→ **Gunakan Opsi 2** (Run Migrations)
- Database clean
- Bisa isi data manual nanti

**✅ Punya data custom di lokal:**
→ **Gunakan Opsi 3** (Copy dari lokal)

---

## 📋 Checklist Setup Database

- [ ] MySQL service di Railway sudah running
- [ ] Kredensial database sudah dicatat (HOST, PORT, USER, PASSWORD, DATABASE)
- [ ] MySQL Workbench sudah diinstall (untuk Opsi 1)
- [ ] Connection ke Railway database berhasil
- [ ] File SQL sudah diimport ATAU migrations sudah jalan
- [ ] Verify: tabel sudah ada dan berisi data
- [ ] Test login aplikasi dengan user dari database

---

## 🔧 Troubleshooting

### "Can't connect to MySQL server"
- Pastikan Railway MySQL service sudah running (indikator hijau)
- Cek kredensial (HOST, PORT, USER, PASSWORD) sudah benar
- Pastikan internet connection stabil

### "Access denied for user"
- Password salah, copy lagi dari Railway Variables
- Username salah, pastikan pakai MYSQLUSER dari Railway

### "Unknown database 'railway'"
- Di MySQL Workbench, saat import:
  - Jangan set "Default Target Schema"
  - Atau buat schema dulu dengan nama dari MYSQLDATABASE Railway

### Import SQL error "Table already exists"
- Database sudah ada isinya
- Drop tables dulu atau buat database baru
- Atau edit SQL file (hapus baris CREATE TABLE yang error)

### Setelah import, data tidak muncul
- Refresh connection: Database → Refresh All
- Atau disconnect dan connect ulang
- Run query: `SELECT * FROM user;` untuk test

---

## 📝 Kredensial Default Setelah Import

Jika menggunakan file `db/dummyhr.sql`, kredensial login:

**User dari database SQL:**
- Cek di tabel `user` untuk username dan password yang di-hash

**Atau jika pakai seeder:**
- Username: `kepala`
- Password: `danu`
- Role: kepala_yayasan

---

## ⚡ Quick Start (Tercepat)

```
1. Download MySQL Workbench
2. Install
3. Buka → New Connection
4. Isi kredensial dari Railway
5. Connect
6. Server → Data Import
7. Pilih file db/dummyhr.sql
8. Start Import
9. Selesai! ✅
```

Total waktu: ~5-10 menit

---

**Pilih salah satu opsi di atas sesuai kebutuhan Anda!** 🚀

Jika masih ada masalah, screenshot errornya dan saya akan bantu lebih lanjut.

