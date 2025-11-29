# WEB SERVER OPEN LITESPEED (OLS) 🔥🚀

> [!NOTE]  
> _Yaah kami dari kelompok 6 diberi tugas ntuk membuat web server. Saat ini kami kelas 11 jurusan TJKT, btw mapel KKTKJ. :D_ 💪

## Perkenalan Kelompok 👥
Tak kenal maka tak sayang, sudah kenal tapi ga sayang sayangg wakkwak 😂  
Okey kami kelompok **Flamboyan** 🌺 beranggotakan 3 orang ganteng maksimal:

- Mochammad Rayhan Febian 👑  
- Alfareza Heryana Putra 🧙‍♂️  
- Latif Sahrul Siddiq 😈  

## A. Pembahasan

### 1. Mengakses Server, Menginstall Web Server (OLS), Uji Coba

#### 1.1 Akses Server 🖥️
Jadi cara akses servernya sangat mudah, hanya perlu *cmd* bawaan windows, dengan cara berikut:
```shell
ssh username@ip
```
> _username sama ip nya sesuai yang diberikan di lms kami mwhehee_ 😜

#### 1.2 Menginstall Web Server ⚡
Setelah bisa masuk ke server kita perlu install dahulu web servernyaa. Caranya gampang (oh iya jangan lupa pake sudo yaak karena kami pake user biasaa):

```shell
sudo apt install wget curl
sudo wget -O - https://repo.litespeed.sh | sudo bash
sudo apt install openlitespeed
sudo apt install lsphp84 lsphp84-mysql
sudo systemctl start lsws
sudo systemctl enable lsws
```

Nahh kalau sudah diinstall OLS dan kawannya ini, langsung saja buat akun untuk nanti login di panel OLS nya:
```shell
/usr/local/lsws/admin/misc/admpass.sh
```
Bebas laah user dan passwordnya, asal inget wkwk 😅

> [!TIP]  
> Oke setelah selesai itu semua, selanjutnya tinggal masuk ke panel OLSnya lewat browser:  
> ➡️ `http://ip-server:7080`  
> Masukin user + password yang tadi dibuat ya!

> [!TIP]  
> Cek web defaultnya juga udah bisa kok:  
> ➡️ `http://ip-server:8088` 🎉

#### 1.2.1 Settings Panel OLS ⚙️
Setelah berhasil masuk, gaskeun kita setting-setting! (Tiap selesai setting jangan lupa **Save** + **Graceful Restart** ya geys 🔥)

**1) Ngatur versi PHP dulu geys**  
a. Server Configuration → External App  
b. Add → LiteSpeed SAPI App → Next

```
Name               : lsphp84
Address            : uds://tmp/lshttpd/lsphp.sock
Notes              : PHP 8.4
Max Connections    : 35
Initial Request Timeout : 60
Retry Timeout      : 0
Persistent Connection : Yes
Command            : /usr/local/lsws/lsphp84/bin/lsphp
Instances          : 1
```

**2) Ngatur Script Handler**  
Server Configuration → Script Handler → Edit atau Add baru:
```
Suffixes      : php
Handler Type  : LiteSAPI
Handler Name  : lsphp84
```

**3) Ubah port HTTP jadi 80** (biar ga ribet ketik 8088)  
Listeners → Default → Edit → Port: `80`

**4) Biar bisa baca index.php dulu**  
Virtual Hosts → Example → Index Files → Tambah `index.php` di depan `index.html`

**5) Buat Self-Signed SSL (HTTPS)** 🔒  
Pertama masuk root dulu via SSH:
```shell
sudo mkdir /etc/ssl/private
sudo -i
cd /etc/ssl/private
openssl req -x509 -newkey rsa:2048 -nodes -keyout self.key -out self.crt -days 365
```
Isi data asal-asalan juga gapapa kok 😆

Kembali ke panel OLS:  
Listeners → Add → Listener Name: `SSL`
```
IP Address : IPV4ANY
Port       : 443
Secure     : Yes
```
Virtual Host Mapping → Example → Domain `*`

Tab SSL:
```
Private Key File   : /etc/ssl/private/self.key
Certificate File   : /etc/ssl/private/self.crt
```
➡️ Graceful Restart → Done!

#### 1.3 Uji Coba 🎯
Gampang banget:
- HTTP  ➡️ `http://ip-server`  
- HTTPS ➡️ `https://ip-server`  

Kalau muncul website kita → SUCCESS! 🏆

### 2. Kelebihan dan Kekurangan Open LiteSpeed (OLS)

| Kelebihan 🔥                              | Kekurangan 😅                              |
|------------------------------------------|---------------------------------------------|
| Lebih cepat dari Apache kalau banyak pengunjung | Fitur lebih sedikit dibanding Apache/Nginx |
| Hemat RAM banget                         | Belum support HTTP/3                        |
| Bisa pakai .htaccess langsung (no rewrite ribet) | Komunitas kecil → susah cari solusi        |
| Ada panel web (super gampang buat pemula) | Kurang jago reverse proxy (Nginx menang)   |
| PHP langsung jalan tanpa setting banyak  | Fitur canggih = versi Enterprise (bayar) 💸|

```Sumber: grok ai```

### 3. Cara Membuat Projek HTML + Upload ke Server 📤
**Cara buat base htmlnya atau halaman depan**

Kami pakai AI Deepseek dengan prompt:  

_"Buat website sederhana 2 halaman (welcome + profil anggota kelompok), fully responsive, tema dan vibes demonic yang kuat dan menarik."_ 😈🔥

Hasilnya? Mahakarya luar biasa (menurut ~R sih wkwk). Terus kami edit-edit lagi biar makin keren + bikin halaman profil masing-masing anggota.

**Cara Upload pakai WinSCP (user biasa):**
1. Buka WinSCP → Hostname = IP server, Username & Password sesuai VPS  
2. Advanced → SFTP → SFTP Server isi:  
   ```
   sudo /usr/lib/openssh/sftp-server
   ```
3. Login → Buka folder:  
   `/usr/local/lsws/Example/html`
4. Hapus semua file bawaan → Upload file kita (index.php, css, js, gambar, dll)

SELESAI! 🥳

## B. Kendala serta Solusi 🛠️
Alhamdulillah kendala minim, tapi tetap ada beberapa:

| No | Kendala                              | Solusi                                      |
|----|--------------------------------------|---------------------------------------------|
| 1  | Lupa pake `sudo` → Permission denied | Selalu ketik `sudo` di depan perintah       |
| 2  | Gak bisa masuk folder tertentu       | Pakai `sudo -i` dulu baru masuk root        |
| 3  | Port 80/443 sudah dipake             | Matikan service lain atau ganti port dulu   |
| 4  | HTTPS error sertifikat               | Pakai self-signed dulu buat testing         |


## C. Kesimpulan ✨
Akhirnya kelompok Flamboyan berhasil membuat web server menggunakan **OpenLiteSpeed** via VPS dari nol sampai bisa diakses via HTTP & HTTPS! 🎉  
Prosesnya seru, banyak belajar tentang SSH, instalasi package, konfigurasi panel, sampai upload file pakai WinSCP. Walaupun ada sedikit kendala, semua teratasi dengan sabar dan googling bareng-bareng.

OpenLiteSpeed ternyata **super cepat**, **ringan**, dan **ramah pemula** berkat panel webnya. Cocok banget buat pelajar kayak kami yang baru belajar server. Tema demonic website kami juga jadi bikin orang takut tapi keren abis 😈🔥

Terima kasih buat guru, temen-temen, GROK, dan tentunya kelompok Flamboyan cihuy

Semoga nilai kita maksimal ya Allah 🤲

## D. 🎬 Dokumentasi Video Pengerjaan
[![Thumbnail Video Pengerjaan](https://img.youtube.com/vi/zErzzyqL34E/0.jpg)](https://youtu.be/zErzzyqL34E)

**SELESAI DENGAN SIGMA** 🏆🔥

~ Kelompok 6 - Flamboyan - XI TJKT ~
