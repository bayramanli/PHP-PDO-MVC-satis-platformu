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

#### Projenin Localhostta çalışabilmesi için aşağıdaki adımlar izlenmelidir.
Bu adımlar wampserver üzerinden gösteriliyor. Diğer local sunucular için adımlar benzerdir.

1.) Belirtilen bu yola C:\wamp64\bin\apache\apache2.4.37\conf gidilerek httpd.conf dosyası açılır. Bu dosya içerisinde aşağıda belirtilen ifadenin önünde # işareti varsa kaldırın ve kaydedin.
	Include conf/extra/httpd-vhosts.conf

2.) Daha sonra buraya gidin C:\wamp64\bin\apache\apache2.4.37\conf\extra , ardından httpd-vhosts.conf dosyasını açın ve en alta aşağıdaki ifadeyi ekleyin.
<VirtualHost *:80>
ServerName projeadi //buraya proje adı yazılır
DocumentRoot "C:/wamp64/www/projenin bulunduğu klasör yazılır"
</VirtualHost>

3.) Not defterini yönetici olarak çalıştırın ve bu dosya yolunu açın C:\Windows\System32\drivers\etc , ardından hosts dosyasını açın ve aşağıdaki ifadeyi ekleyiniz.
127.0.0.1 projeadi
