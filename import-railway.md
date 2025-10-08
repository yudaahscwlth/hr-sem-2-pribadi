# Cara Import Database ke Railway - Panduan Lengkap

## ⚡ Opsi 1: MySQL Workbench (RECOMMENDED untuk Windows)

### Install & Setup
1. Download MySQL Workbench: https://dev.mysql.com/downloads/workbench/
2. Install seperti biasa

### Dapatkan Kredensial Railway
1. Login ke railway.app
2. Buka project DummyHR
3. Klik MySQL service
4. Tab "Variables" → catat:
   - MYSQLHOST
   - MYSQLPORT
   - MYSQLDATABASE
   - MYSQLUSER
   - MYSQLPASSWORD

### Import Database
1. Buka MySQL Workbench
2. New Connection (+):
   - Connection Name: Railway DummyHR
   - Hostname: [MYSQLHOST dari Railway]
   - Port: [MYSQLPORT dari Railway]
   - Username: [MYSQLUSER dari Railway]
   - Password: Store in Vault → [MYSQLPASSWORD dari Railway]
3. Test Connection → OK
4. Double-click connection
5. Menu: **Server → Data Import**
6. Import from Self-Contained File
7. Browse: `D:\TesSem2\dummyhr\db\dummyhr.sql`
8. Default Target Schema: pilih database Railway
9. Start Import
10. Tunggu selesai ✅

### Verifikasi
```sql
SELECT * FROM users LIMIT 5;
SELECT * FROM pegawai LIMIT 5;
SELECT COUNT(*) FROM kehadiran;
```

---

## ⚡ Opsi 2: Railway CLI (Untuk yang suka terminal)

### Install Railway CLI
```bash
npm install -g @railway/cli
```

### Login & Link Project
```bash
# Login
railway login
# Browser akan terbuka, approve

# Link ke project
cd D:\TesSem2\dummyhr
railway link
# Pilih project DummyHR
```

### Import Database

**Cara 1: Pipe file SQL**
```bash
railway run bash -c "cat db/dummyhr.sql | mysql -h \$MYSQLHOST -u \$MYSQLUSER -p\$MYSQLPASSWORD -P \$MYSQLPORT \$MYSQLDATABASE"
```

**Cara 2: Jika Anda punya MySQL client lokal (XAMPP/Laragon)**
```bash
# Dapatkan kredensial Railway
railway variables

# Gunakan MySQL dari XAMPP
C:\xampp\mysql\bin\mysql -h [HOST] -u [USER] -p[PASSWORD] -P [PORT] [DATABASE] < db/dummyhr.sql
```

### Verifikasi
```bash
railway run php artisan tinker
# Di tinker:
DB::table('users')->count();
DB::table('pegawai')->count();
```

---

## ⚡ Opsi 3: Gunakan DBeaver (Free Alternative)

### Install
Download DBeaver Community: https://dbeaver.io/

### Setup Connection
1. New Database Connection → MySQL
2. Isi kredensial dari Railway
3. Test Connection → Finish

### Import
1. Klik kanan database → Tools → Execute SQL Script
2. Pilih file: `db/dummyhr.sql`
3. Execute

---

## 🔧 Troubleshooting

### "Can't connect to MySQL server"
✅ Pastikan:
- Railway MySQL service running (indikator hijau)
- Kredensial benar (copy-paste dari Railway Variables)
- Internet connection stabil

### "Access denied for user"
✅ Password salah:
- Copy ulang MYSQLPASSWORD dari Railway
- Jangan ada spasi di awal/akhir

### "Unknown database"
✅ Target schema salah:
- Gunakan nama database dari MYSQLDATABASE Railway
- Biasanya `railway`

### "Table already exists"
✅ Database sudah ada isinya:
- Drop tables dulu, atau
- Edit file SQL (tambahkan `DROP TABLE IF EXISTS` di setiap tabel)

### Import SQL error di tengah jalan
✅ Cek:
- File SQL corrupt? Buka dengan text editor
- Encoding file? Pastikan UTF-8
- Size file terlalu besar? Coba split file

---

## 📊 Perbandingan Metode

| Metode | Kecepatan | Kesulitan | Cocok Untuk |
|--------|-----------|-----------|-------------|
| MySQL Workbench | ⭐⭐⭐⭐⭐ | Mudah | Pemula, Windows user |
| Railway CLI | ⭐⭐⭐⭐ | Sedang | Developer |
| DBeaver | ⭐⭐⭐⭐ | Mudah | Yang suka open-source |
| XAMPP MySQL | ⭐⭐⭐ | Sedang | Sudah ada XAMPP |

---

## 📝 Setelah Import Berhasil

### Update Environment Variables Laravel di Railway

Pastikan Laravel service di Railway punya variables:
```
DB_CONNECTION=mysql
DB_HOST=${MySQL.MYSQLHOST}
DB_PORT=${MySQL.MYSQLPORT}
DB_DATABASE=${MySQL.MYSQLDATABASE}
DB_USERNAME=${MySQL.MYSQLUSER}
DB_PASSWORD=${MySQL.MYSQLPASSWORD}
```

### Redeploy Laravel Application
1. Di Railway Dashboard → Laravel service
2. Klik "Deploy" atau push ke GitHub (auto-deploy)

### Test Aplikasi
1. Buka URL Railway: `https://your-app.up.railway.app`
2. Login dengan user dari database
3. Cek fitur-fitur aplikasi

---

## 🎯 Kesimpulan

**Untuk Windows, saya SANGAT REKOMENDASIKAN Opsi 1 (MySQL Workbench):**
- ✅ GUI mudah digunakan
- ✅ Gratis
- ✅ Reliable
- ✅ Bisa untuk manage database juga
- ✅ Waktu: ~5-10 menit

**Jika error atau butuh bantuan lebih lanjut:**
- Screenshot error message
- Catat di step mana error terjadi
- Check Railway logs: railway logs

Good luck! 🚀

