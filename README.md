# Satış Platformu

*PHP VE PDO ile MVC mimarisine uygun bir şekilde geliştirilmiş satış platformudur.*

**Projede; satış yapabilen, satışlardan doğan primleri saklayan, müşteri, kullanıcı, kullanıcı rollerini, ürün ve kategorileri barındıran bir satış platformudur.**

### Veritabanı bağlantısı ve bilgileri
Veritabanı bağlantısı için ```app/config.php``` dosyasında, aşağıdaki bilgiler düzenlenmelidir.

```php
define('DBHOST','localhost'); // veritabanı sunucu adı
define('DBUSER','root'); // veritabanı kullanıcı adı
define('DBPASS',''); // veritabanı şifre
define('DBNAME','banli'); // veritabanı adı
```

### Admin Giriş bilgileri
	Email Adresi: admin@admin.com
	Şifre: 123456
### User Giriş Bilgileri
	Email Adresi: deneme@deneme.com
	Şifre: 123456

![admin panel user](https://github.com/bayramanli/PHP-PDO-MVC-satis-platformu/blob/master/resimler/adminpanel-users.PNG)
