# Cara Import Database ke Railway dari Windows

## Problem: MySQL Command Not Found

Error `mysql: command not found` terjadi karena MySQL client tidak terinstall atau tidak ada di PATH Windows.

## Solusi Praktis untuk Windows

### ✅ Opsi 1: Gunakan Railway CLI (Recommended)

**Langkah-langkah:**

1. **Install Railway CLI:**
   ```bash
   npm install -g @railway/cli
   ```

2. **Login ke Railway:**
   ```bash
   railway login
   ```
   Browser akan terbuka untuk authentication.

3. **Link ke Project:**
   ```bash
   railway link
   ```
   Pilih project DummyHR Anda.

4. **Import Database:**
   ```bash
   # Railway CLI otomatis load environment variables
   railway run bash -c "mysql -h \$MYSQLHOST -u \$MYSQLUSER -p\$MYSQLPASSWORD -P \$MYSQLPORT \$MYSQLDATABASE < db/dummyhr.sql"
   ```
   
   Atau jika error, coba cara alternatif:
   ```bash
   # Copy file SQL ke Railway environment dan import
   cat db/dummyhr.sql | railway run mysql -h \$MYSQLHOST -u \$MYSQLUSER -p\$MYSQLPASSWORD -P \$MYSQLPORT \$MYSQLDATABASE
   ```

### ✅ Opsi 2: MySQL Workbench (GUI)

**Download & Install:**
- https://dev.mysql.com/downloads/workbench/

**Steps:**
1. Buka MySQL Workbench
2. Klik "+" untuk New Connection
3. Isi kredensial dari Railway:
   - Connection Name: `Railway DummyHR`
   - Hostname: [dari Railway MYSQLHOST]
   - Port: [dari Railway MYSQLPORT]
   - Username: [dari Railway MYSQLUSER]
   - Password: [Store in Keychain, masukkan MYSQLPASSWORD]
   - Default Schema: [dari Railway MYSQLDATABASE]

4. Test Connection
5. Jika sukses, double-click connection
6. Menu: Server → Data Import
7. Pilih "Import from Self-Contained File"
8. Browse: `db/dummyhr.sql`
9. Target Schema: pilih database Railway
10. Click "Start Import"

### ✅ Opsi 3: Gunakan MySQL dari XAMPP/Laragon

Jika Anda sudah install XAMPP atau Laragon, MySQL client sudah tersedia:

#### **Untuk XAMPP:**
```bash
# Tambahkan MySQL ke PATH sementara
export PATH=$PATH:/c/xampp/mysql/bin

# Lalu jalankan import
mysql -h [HOST] -u [USER] -p[PASSWORD] -P [PORT] [DATABASE] < db/dummyhr.sql
```

Atau langsung dengan path lengkap:
```bash
/c/xampp/mysql/bin/mysql -h [HOST] -u [USER] -p[PASSWORD] -P [PORT] [DATABASE] < db/dummyhr.sql
```

#### **Untuk Laragon:**
```bash
# Path bisa berbeda tergantung versi, cek di folder Laragon Anda
/c/laragon/bin/mysql/mysql-8.0.30-winx64/bin/mysql -h [HOST] -u [USER] -p[PASSWORD] -P [PORT] [DATABASE] < db/dummyhr.sql
```

**Cara cek path MySQL:**
```bash
# Di Windows Explorer, buka:
# XAMPP: C:\xampp\mysql\bin\
# Laragon: C:\laragon\bin\mysql\[versi]\bin\

# Atau di Git Bash:
ls /c/xampp/mysql/bin/mysql.exe
ls /c/laragon/bin/mysql/*/bin/mysql.exe
```

### ✅ Opsi 4: Deploy & Gunakan Migrations (Tanpa Import SQL)

Jika ribet import SQL, gunakan migrations yang sudah diperbaiki:

1. **Push code ke GitHub** (jika belum)
   ```bash
   git add .
   git commit -m "Fix migrations sesuai database structure"
   git push origin main
   ```

2. **Deploy ke Railway:**
   - Railway akan auto-deploy dari GitHub

3. **Set Environment Variables di Railway**
   
4. **Run Migrations via Railway CLI:**
   ```bash
   railway run php artisan migrate --force
   ```

5. **Run Seeders untuk data awal:**
   ```bash
   railway run php artisan db:seed --force
   ```

### ✅ Opsi 5: TablePlus / DBeaver (GUI Alternatif)

**TablePlus** (Paid, tapi ada free trial):
- Download: https://tableplus.com/
- Mudah digunakan, support banyak database

**DBeaver** (Free & Open Source):
- Download: https://dbeaver.io/
- Gratis dan powerful

**Cara pakai:**
1. Install salah satu tool
2. Buat connection baru dengan kredensial Railway
3. Import SQL file dari GUI

### ✅ Opsi 6: Online Tool (Temporary Solution)

Jika database tidak terlalu besar, bisa gunakan Railway Web Terminal (jika tersedia):

1. Di Railway Dashboard → MySQL Service
2. Cari opsi "Connect" atau "Shell"
3. Jika ada web terminal, paste isi SQL file

## Rekomendasi

**Untuk situasi Anda sekarang, saya rekomendasikan:**

1. **Tercepat:** Opsi 2 (MySQL Workbench) - GUI, mudah, gratis
2. **Paling Praktis:** Opsi 1 (Railway CLI) - sekali setup, bisa dipakai terus
3. **Termudah:** Opsi 4 (Deploy & Migrations) - tidak perlu import SQL

## Contoh Lengkap dengan Railway CLI

```bash
# 1. Install Railway CLI
npm install -g @railway/cli

# 2. Login
railway login
# Browser akan terbuka, approve login

# 3. Link project
cd /d/TesSem2/dummyhr
railway link
# Pilih project DummyHR

# 4. Check environment variables
railway variables
# Pastikan MYSQL* variables ada

# 5. Import database
railway run bash -c 'mysql -h $MYSQLHOST -u $MYSQLUSER -p$MYSQLPASSWORD -P $MYSQLPORT $MYSQLDATABASE < db/dummyhr.sql'

# Atau alternatif jika MySQL client masih error di Railway:
# Deploy dulu, lalu run migrations
railway up
railway run php artisan migrate --force
railway run php artisan db:seed --force
```

## Troubleshooting

### "npm: command not found"
Install Node.js dari: https://nodejs.org/

### "railway: command not found" setelah install
```bash
# Restart Git Bash atau terminal
# Atau coba:
npx @railway/cli login
npx @railway/cli link
```

### Railway CLI tidak bisa run mysql command
Gunakan opsi GUI (MySQL Workbench) atau deploy + migrations

## Kesimpulan

**Pilih salah satu cara di atas yang paling sesuai:**
- ✅ Punya Node.js → Pakai Railway CLI (Opsi 1)
- ✅ Suka GUI → Pakai MySQL Workbench (Opsi 2)
- ✅ Ada XAMPP/Laragon → Gunakan MySQL dari situ (Opsi 3)
- ✅ Mau simple → Deploy & Run Migrations (Opsi 4)

Semua cara di atas valid dan akan menghasilkan hasil yang sama! 🚀

