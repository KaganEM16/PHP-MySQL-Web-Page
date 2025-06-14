
# 🚀 Proje: PHP & MySQL Web Tabanlı Uygulama

## Açıklama
Bu proje, PHP, MySQL, HTML ve Bootstrap (veya benzeri bir CSS kütüphanesi) kullanılarak geliştirilmiş bir CRUD uygulamasıdır. İçeriği:

1. Kullanıcı kaydı, şifreli giriş ve oturum yönetimi  
2. Kullanıcı tarafından bilgi girişi ve veritabanına kayıt  
3. Girilen bilgileri listeleme  
4. Bilgi silme  
5. Bilgileri düzenleme  

Backend tamamen saf PHP ile yazılmıştır, hiçbir harici PHP framework/kütüphanesi içermez. Frontend Bootstrap ile stilize edilmiş olup önyüzü JS ile zenginleştirilebilir.

## 📋 Özellikler

- **Kullanıcı yönetimi**:  
  - Kayıt, giriş, çıkış  
  - Şifreler `password_hash()` ile hash’lenir  
  - Oturum yönetimi `session` ile sağlanır
- **CRUD işlemleri**:  
  - Bilgi ekleme, listeleme, düzenleme ve silme  
- **Veritabanı yapısı**:  
  - En az bir tablo (`accounts`)  
  - `id, username, password, email, registered` alanlarını içerir

## 📂 Proje Yapısı

```
/                     # Proje kök dizini
 ├─ index.php         # Giriş sayfası
 ├─ register.php      # Kullanıcı kayıt sayfası
 ├─ authenticate.php  # Giriş işlemleri
 ├─ logout.php        # Çıkış işlemi
 ├─ home.php          # Giriş sonrası ana sayfa
 ├─ profile.php       # Profil görüntüleme/düzenleme
 ├─ create.php        # Veri ekleme (CRUD)
 ├─ edit.php          # Veri düzenleme
 ├─ delete.php        # Veri silme
 ├─ config.php        # DB bağlantı ayarları
 ├─ common.php        # Ortak fonksiyonlar (html escape vb.)
 ├─ css/
 │   └─ style.css     # Stil dosyası (Bootstrap)
 ├─ js/
 │   └─ app.js        # (İsteğe bağlı) JavaScript eklemeleri
 └─ sql/
     └─ init.sql      # DB yapılandırma SQL dosyası
```

## ⚙️ Kurulum

1. Reposu klonlayın:
   ```bash
   git clone https://github.com/KaganEM16/PHP-MySQL-Web-Page.git
   cd PHP-MySQL-Web-Page
   ```
2. PHP + MySQL destekli bir sunucuya (XAMPP, LAMP, WAMP vb.) taşıyın.
3. Veritabanını oluşturun:
   ```sql
   CREATE DATABASE uygProjekt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   USE uygProjekt;
   SOURCE sql/init.sql;
   ```
4. `config.php` içindeki DB bilgilerini düzenleyin:
   ```php
   $DATABASE_HOST = 'localhost';
   $DATABASE_USER = 'root';
   $DATABASE_PASS = '';
   $DATABASE_NAME = 'uygProjekt';
   ```
5. Sunucuyu başlatıp tarayıcıda `http://localhost/.../index.php` erişin.

## 🔐 Güvenlik / Mühendislik Detayları

- Şifreler **hashlenerek** (`password_hash()`) saklanır.
- Kullanıcı doğrulaması **prepared statements** ile yapılır.
- **Session** ile oturum yönetimi yapılır.
- HTML çıkışları `htmlspecialchars()` ile temizlenir.
- HTTPS kullanım önerilir.

## 🧾 Kullanım Talimatları

1. **Kayıt**: `register.php` üzerinden kullanıcı oluşturun.
2. **Giriş**: `index.php` ile oturum açın.
3. **Ana Sayfa**: `home.php` kullanıcıya özel içerik sunar.
4. **Bilgi Ekleme**: `create.php` formu ile veri girin.
5. **Düzenleme**: `edit.php?id=<veri_id>` şeklinde veriyi düzenleyin.
6. **Silme**: `delete.php?id=<veri_id>` ile veriyi silin.
7. **Çıkış**: `logout.php` ile oturumu sonlandırın.

## 📌 Dikkat Edilmesi Gerekenler

- `.htaccess` kullanımı projenin gereksinimleri dışında bırakılmıştır.
- Yayına geçirilirken `config.php` ve diğer hassas bilgiler güncellenmeli/gizlenmelidir.
- GitHub’da `.gitignore` dosyasına `config.php` gibi hassas dosyaları ekle.

## ✅ Ödev Gereklilikleri ile Uyum

- Sadece **bir MySQL tablosu** kullanılmıştır (`accounts` + CRUD için ek tablo).
- Şifreler hash'lenmiştir.
- Session ile kullanıcı doğrulaması sağlanmıştır.
- Harici PHP kod veya framework **kullanılmamıştır**.
- JavaScript kullanımı isteğe bağlıdır.

## 🛠️ Geliştirme ve Dağıtım Notları

- Lokal ortamda çalışıp, hosting sunucusuna aktardığında veritabanı bilgisi adaptasyonu yapmayı unutma.
- GitHub’a hassas veriler **commit edilmemelidir**.

## 📚 Kaynaklar

- https://www.php.net/manual/en/function.password-hash.php  
- https://www.php.net/manual/en/session.examples.basic.php
