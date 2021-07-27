Admin Giriþ bilgileri
	Email Adresi: admin@admin.com
	Þifre: 123456
User Giriþ Bilgileri
	Email Adresi: deneme@deneme.com
	Þifre: 123456

Projenin Localhostta çalýþabilmesi için aþaðýdaki adýmlar izlenmelidir.
Bu adýmlar wampserver üzerinden gösteriliyor. Diðer local sunucular için adýmlar benzerdir.

1.) Belirtilen bu yola C:\wamp64\bin\apache\apache2.4.37\conf gidilerek httpd.conf dosyasý açýlýr. Bu dosya içerisinde aþaðýda belirtilen ifadenin önünde # iþareti varsa kaldýrýn ve kaydedin.
	Include conf/extra/httpd-vhosts.conf

2.) Daha sonra buraya gidin C:\wamp64\bin\apache\apache2.4.37\conf\extra , ardýndan httpd-vhosts.conf dosyasýný açýn ve en alta aþaðýdaki ifadeyi ekleyin.
<VirtualHost *:80>
ServerName projeadi //buraya proje adý yazýlýr
DocumentRoot "C:/wamp64/www/projenin bulunduðu klasör yazýlýr"
</VirtualHost>

3.) Not defterini yönetici olarak çalýþtýrýn ve bu dosya yolunu açýn C:\Windows\System32\drivers\etc , ardýndan hosts dosyasýný açýn ve aþaðýdaki ifadeyi ekleyiniz.
127.0.0.1 projeadi