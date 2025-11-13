# WEB SERVER OPEN LITE SPEED (OLS)
> [!NOTE]
> _Yaah kami dari kelompok 6 diberi tugas ntuk membuat web server. Saat ini kami kelas 11 jurusan TJKT, btw mapel KKTKJ. :D_

## 1. Mengakses Server, Menginstall Web Server (OLS), Uji Coba
### 1.1 Akses Server
Jadi cara akses servernya sangat mudah, hanya perlu *cmd* bawaan windows, dengan cara berikut :

```shell
ssh username@ip
```

_username sama ip nya sesuai yang diberikan di lms kami mwhehee_

### 1.2 Menginstall Web Server
Setelah bisa masuk ke server kita perlu install dahulu web servernyaa. caranya gampang (oh iya jangan lupa pake sudo yaak karena kami pake user biasaa) :

```shell
sudo apt install wget curl
sudo wget -O - https://repo.litespeed.sh | sudo bash
sudo apt install openlitespeed
sudo apt install lsphp84 lsphp84-mysql
sudo systemctl start lsws sudo enable lsws
``` 
nahh kalau sudah diinstall ols dan kawannya ini, langsung saja buat akun untuk nanti login di panel ols nya dengan kode berikut :
```shell
/usr/local/lsws/admin/misc/admpass.sh
```
bebas laah user dan passwordnya, asal inget wkwk


> [!Tip]
>  Oke setelah selesai itu semua, selanjutnya tinggal masuk ke panel olsnya lewat browser, gimana? ginii :
> ```http://ip-server:7080```
> abistu masukan aja user sama password yang udah dibuat tadi

> [!Tip]
> ohh iya, kalau mau cek web defaultnya juga udah bisa kok, pake ini :
> ```http://ip-server:8088```

### 1.2.1 Settings Panel OLS
setelah berhasil masuk, gaskeun kita setting setting, apa aja tuh ? nihh (btw, tiap selesai setting jangan lupa save uy):

***1) Ngatur versi PHP dulu geys.***

a. Di panel klik Server Configuration terus External App

b. Tambah baru dengan cara Add terus pilih yang LiteSpeed SAPI App, terus next

```
Settingnya : 
Name: lsphp84
Address: uds://tmp/lshttpd/lsphp.sock
Notes: PHP 8.4
Max Connections: 35
Initial Request Timeout: 60
Retry Timeout: 0
Persistent Connection: Yes
Command: /usr/local/lsws/lsphp84/bin/lsphp
Instances: 1 (default)
```

***2) Ngatur Script Handler***

a. Server Configuration → Script Handler

b. Edit handler lsphp atau buat baru:

```
Suffixes: php
Handler Type: LiteSpeed SAPI
Handler Name: lsphp84
```
***3) Ubah port http (yaitu 80) karena defaultnya kan 8088***

a. Buka menu listeners, pilih yang Default terus edit

b. Terus tinggal ganti aja deh portnya jadi 80

***4) Ubah supaya web bisa baca index.php***

a. Buka Virtual Host, Example terus edit

b. Cari bagian index file, terus tambahin ```index.php```, ```index.html``` (biar index.php dicari dahulu baru index.html)

***5) Buat Self-Signed SSL***

_nah khusus ini, kita buat dulu di ssh (cmd), tapii ada harus masuk pake root dulu, jangan khawatir ikuti saja codenya_

```shell
sudo mkdir /etc/ssl/private
sudo -i
cd /etc/ssl/private
(nah ini sudo -i bakal masuk ke root)
```
nextnya :
```shell
openssl req -x509 -newkey rsa:2048 -nodes -keyout self.key -out self.crt -days 365
```
_Isi asal aja sih. terus nanti bakal punya dua file self.key dan self.crt yang tersimpan di_ ```/etc/ssl/private```

a. Sekarang ke panel OLS lagi, terus ke Listeners lalu add

b. Listener Name: SSL
```
IP Address: IPV4ANY
Port: 443
Secure: Yes
```
```
di bagian Virtual host mappings: 
Virtual Host: Example (atau nama virtual host kamu)
Domains: * (artinya semua domain/IP)
```
c. Klik Tab SSL, isi pake dua file yang tadi :
```
Private Key File: /etc/ssl/private/self.key
Certificate File: /etc/ssl/private/self.crt
``` 
restart dehhh, tinggal uji cobaa. eh tapi belum deng, ada yang harus kita masukkan ke Server (pake WinSCP) yaituuu html/php kami. nahh tapi itu nanti di poin 3 aja dah awkkwa.

### 1.3 Uji Coba

Untuk uji coba sih simple :


> http://ip-server


> https://ip-server

yups semudah itu bwahaha

## 2. Kelebihan dan Kekurangan Open Lite Speed (OLS)
> Kelebihan (dibanding Apache2 & Nginx):
> 1. Lebih cepat dari Apache2 kalau banyak pengunjung.
> 2. Hemat RAM.
> 3. Bisa pakai .htaccess langsung (sama kayak Apache2, gak perlu ribet kayak Nginx).
> 4. Ada panel di browser (bisa atur lewat web, lebih gampang).
> 5. PHP langsung jalan tanpa setting banyak.

> Kekurangan:
> 1. Fitur sedikit (gak sebanyak Apache2).
> 2. Gak bisa HTTP/3 (Apache2 & Nginx bisa).
> 3. Orang pakainya lebih sedikit, jadi bantuan di internet kurang.
> 4. Gak jago buat reverse proxy kayak Nginx.
> 5. Kalau mau fitur canggih, harus bayar (versi Enterprise).

```sumber : GROK :D```

## 3. Cara membuat projek html dan cara upload ke servernya

berlanjut..
