Admin Giri� bilgileri
	Email Adresi: admin@admin.com
	�ifre: 123456
User Giri� Bilgileri
	Email Adresi: deneme@deneme.com
	�ifre: 123456

Projenin Localhostta �al��abilmesi i�in a�a��daki ad�mlar izlenmelidir.
Bu ad�mlar wampserver �zerinden g�steriliyor. Di�er local sunucular i�in ad�mlar benzerdir.

1.) Belirtilen bu yola C:\wamp64\bin\apache\apache2.4.37\conf gidilerek httpd.conf dosyas� a��l�r. Bu dosya i�erisinde a�a��da belirtilen ifadenin �n�nde # i�areti varsa kald�r�n ve kaydedin.
	Include conf/extra/httpd-vhosts.conf

2.) Daha sonra buraya gidin C:\wamp64\bin\apache\apache2.4.37\conf\extra , ard�ndan httpd-vhosts.conf dosyas�n� a��n ve en alta a�a��daki ifadeyi ekleyin.
<VirtualHost *:80>
ServerName projeadi //buraya proje ad� yaz�l�r
DocumentRoot "C:/wamp64/www/projenin bulundu�u klas�r yaz�l�r"
</VirtualHost>

3.) Not defterini y�netici olarak �al��t�r�n ve bu dosya yolunu a��n C:\Windows\System32\drivers\etc , ard�ndan hosts dosyas�n� a��n ve a�a��daki ifadeyi ekleyiniz.
127.0.0.1 projeadi