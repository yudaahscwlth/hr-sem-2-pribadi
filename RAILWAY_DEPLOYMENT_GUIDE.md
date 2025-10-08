# Panduan Deploy ke Railway - DummyHR

## Langkah 1: Persiapan Database

### Opsi A: Import Database dari SQL File (Direkomendasikan)

Jika Anda sudah memiliki data di `db/dummyhr.sql`, gunakan cara ini:

1. **Buat MySQL Database di Railway:**
   - Login ke Railway.app
   - Buat project baru atau pilih project existing
   - Klik "+ New" → "Database" → "Add MySQL"
   - Tunggu hingga database siap

2. **Dapatkan Kredensial Database:**
   - Klik MySQL service
   - Tab "Variables" akan menampilkan:
     - `MYSQLHOST`
     - `MYSQLPORT`
     - `MYSQLDATABASE`
     - `MYSQLUSER`
     - `MYSQLPASSWORD`

3. **Import Database SQL:**
   
   Menggunakan MySQL client:
   ```bash
   mysql -h [MYSQLHOST] -u [MYSQLUSER] -p[MYSQLPASSWORD] -P [MYSQLPORT] [MYSQLDATABASE] < db/dummyhr.sql
   ```
   
   Contoh:
   ```bash
   mysql -h containers-us-west-123.railway.app -u root -pABCD1234 -P 5432 railway < db/dummyhr.sql
   ```

### Opsi B: Menggunakan Migrations

Jika ingin fresh installation tanpa data:

1. Buat MySQL database di Railway (sama seperti Opsi A)
2. Nanti akan otomatis run migrations saat deploy

## Langkah 2: Setup Laravel Application di Railway

1. **Deploy dari GitHub:**
   - Di Railway project, klik "+ New"
   - Pilih "GitHub Repo"
   - Pilih repository `dummyhr`
   - Railway akan otomatis detect Laravel

2. **Tambahkan Environment Variables:**

   Di Railway dashboard → Laravel service → Variables, tambahkan:

   ```env
   # Application
   APP_NAME=DummyHR
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://[your-railway-domain].up.railway.app
   
   # Database - Reference dari MySQL service
   DB_CONNECTION=mysql
   DB_HOST=${{MySQL.MYSQLHOST}}
   DB_PORT=${{MySQL.MYSQLPORT}}
   DB_DATABASE=${{MySQL.MYSQLDATABASE}}
   DB_USERNAME=${{MySQL.MYSQLUSER}}
   DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
   
   # Session & Cache
   SESSION_DRIVER=database
   CACHE_STORE=database
   QUEUE_CONNECTION=database
   
   # Logging
   LOG_CHANNEL=stack
   LOG_LEVEL=error
   ```

3. **Generate dan Set APP_KEY:**

   Di terminal lokal, jalankan:
   ```bash
   php artisan key:generate --show
   ```
   
   Copy hasilnya (format: `base64:xxxxx...`) dan tambahkan ke Railway Variables:
   ```
   APP_KEY=base64:yang_anda_dapatkan
   ```

## Langkah 3: Konfigurasi Build & Deploy

Railway akan otomatis detect Laravel dan setup build process. Jika perlu custom:

1. **Buat `nixpacks.toml` (opsional):**
   ```toml
   [phases.setup]
   nixPkgs = ['php82', 'php82Extensions.pdo', 'php82Extensions.pdo_mysql', 'php82Extensions.mbstring']
   
   [phases.install]
   cmds = ['composer install --no-dev --optimize-autoloader']
   
   [phases.build]
   cmds = ['php artisan config:cache', 'php artisan route:cache', 'php artisan view:cache']
   
   [start]
   cmd = 'php artisan serve --host=0.0.0.0 --port=${PORT:-8080}'
   ```

2. **Update Procfile (sudah ada):**
   ```
   web: php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
   ```

## Langkah 4: Deploy!

1. Push perubahan ke GitHub (jika ada perubahan)
2. Railway akan otomatis deploy
3. Atau manual trigger deploy di Railway dashboard

## Langkah 5: Post-Deploy (Jika Menggunakan Migrations)

Jika menggunakan Opsi B (migrations), jalankan di Railway CLI:

```bash
# Install Railway CLI
npm install -g @railway/cli

# Login
railway login

# Link project
railway link

# Run migrations
railway run php artisan migrate --force

# Run seeders (opsional)
railway run php artisan db:seed --force
```

## Troubleshooting

### Error: "No application encryption key"
**Solusi:** Pastikan APP_KEY sudah diset di Railway Variables

### Error: "SQLSTATE[HY000] [2002] Connection refused"
**Solusi:** 
- Cek apakah MySQL service sudah running
- Pastikan database variables benar: `${{MySQL.VARIABLE_NAME}}`
- Tunggu beberapa menit untuk MySQL fully initialize

### Error: "500 Internal Server Error"
**Solusi:**
1. Set `APP_DEBUG=true` sementara untuk melihat error
2. Cek logs di Railway dashboard
3. Pastikan semua environment variables sudah benar

### Database sudah ada tapi migrations error
**Solusi:** Jika Anda sudah import dari SQL file, edit `Procfile` untuk tidak run migrations:
```
web: php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
```

### Storage/Upload files hilang setelah redeploy
**Solusi:** 
- Railway menggunakan ephemeral storage
- Untuk file persistent, gunakan Railway Volumes atau cloud storage (S3, Cloudinary, dll)
- Untuk sementara, file di `public/uploads` akan hilang saat redeploy

## Verifikasi Deployment

1. **Cek Application:**
   ```
   https://[your-app].up.railway.app
   ```

2. **Test Login:**
   - Gunakan kredensial dari database yang diimport
   - Atau kredensial dari seeder

3. **Cek Database Connection:**
   ```bash
   railway run php artisan tinker
   # Di tinker:
   DB::connection()->getPdo();
   # Jika berhasil, akan return PDO object
   ```

## Maintenance

### View Logs:
```bash
railway logs
```

### Run Artisan Commands:
```bash
railway run php artisan [command]
```

### Connect to Database:
```bash
railway connect MySQL
```

## Catatan Penting

1. **Production Mode:** Pastikan `APP_DEBUG=false` di production
2. **Database Backup:** Railway otomatis backup, tapi sebaiknya setup backup manual juga
3. **SSL/HTTPS:** Railway menyediakan SSL otomatis
4. **Custom Domain:** Bisa setup di Railway → Settings → Domains
5. **Environment Variables:** Jangan commit `.env` ke Git!

## Resources

- Railway Docs: https://docs.railway.app
- Laravel Docs: https://laravel.com/docs
- MySQL Connection: https://docs.railway.app/databases/mysql

---

**Status Migrations:** ✅ Sudah diperbaiki dan sesuai dengan `db/dummyhr.sql`

Untuk detail perubahan migrations, lihat file `MIGRATION_CHANGES.md`

