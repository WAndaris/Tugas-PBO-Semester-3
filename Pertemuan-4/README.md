Tugas Rumah PBO Pertemuan 4 — Refactoring & Dokumentasi (Encapsulation)

Nama: Muhammad Farrid Andaris
NIM: 20251020022
Program Studi: Teknik Informatika

Tugas ini merupakan lanjutan dari tugas PBO Pertemuan 3 dengan studi kasus BAAK, yaitu pengelolaan jadwal perkuliahan. Pada tugas ini, class "Jadwal" diperbaiki dengan menerapkan konsep encapsulation.

File PHP yang digunakan: "20251020022_MuhammadFarridAndaris_PBO_M4.php".

A. Refactor — Mengubah Property Menjadi Private

Pada tugas sebelumnya, property "id", "waktu", dan "status" masih menggunakan akses "public". Pada tugas ini, ketiga property tersebut diubah menjadi "private".

Dengan begitu, data di dalam class "Jadwal" tidak bisa diubah secara langsung dari luar class. Contohnya, "$jadwal->status = "disetujui"" tidak bisa digunakan lagi untuk mengubah status jadwal secara langsung.

B. Access — Getter dan Method

Untuk membaca dan mengubah data, class "Jadwal" menggunakan beberapa method berikut:

- "getId()", "getWaktu()", dan "getStatus()" digunakan untuk mengambil nilai dari masing-masing property.
- "setWaktu()" digunakan untuk mengubah waktu jadwal dengan melakukan pengecekan terlebih dahulu.
- "setujui()" digunakan untuk menyetujui jadwal.
- "tandaiBentrok()" digunakan untuk menandai jadwal yang mengalami bentrok.

Method tersebut dibuat agar perubahan data dilakukan melalui class "Jadwal", bukan dengan mengubah property secara langsung. Cara ini juga sesuai dengan konsep encapsulation yang dipelajari pada materi PBO.

C. Validation — Validasi Data

Ada empat aturan validasi yang diterapkan pada class "Jadwal":

1. Format ID: ID harus diawali dengan "JDW" dan diikuti minimal tiga digit, contohnya "JDW001". Pengecekan dilakukan melalui method "setId()" yang bersifat "private" saat objek dibuat melalui constructor.
2. Waktu jadwal: Waktu tidak boleh kosong. Pengecekan dilakukan melalui "setWaktu()", baik saat objek dibuat maupun ketika waktu diubah.
3. Persetujuan jadwal: Jadwal yang sudah ditandai bentrok tidak bisa disetujui. Pengecekan dilakukan melalui method "setujui()".
4. Status bentrok: Jadwal yang sudah disetujui tidak bisa ditandai bentrok. Pengecekan dilakukan melalui method "tandaiBentrok()".

Keempat aturan tersebut sudah memenuhi dan melebihi syarat minimal dua aturan validasi.

D. Test — Pengujian Program

Pengujian dilakukan menggunakan empat skenario untuk memastikan bahwa program berjalan sesuai aturan yang sudah dibuat.

No.| Skenario| Jenis Pengujian| Hasil yang Diharapkan
1| Membuat jadwal valid, kemudian menyetujuinya| Normal| Berhasil dan status berubah menjadi "disetujui"
2| Menggunakan ID dengan format salah ("JADWAL-X")| Input salah| "InvalidArgumentException" tertangkap
3| Menggunakan waktu kosong ("""")| Input salah| "InvalidArgumentException" tertangkap
4| Menandai jadwal sebagai bentrok, kemudian mencoba menyetujuinya| Aturan bisnis / batas| "RuntimeException" tertangkap dan status tetap "bentrok"

Output yang Diharapkan

=== Skenario 1 - Normal: setujui jadwal valid ===
Jadwal JDW001 | Waktu: Senin, 08:00-10:00 | Status: diajukan
-> Jadwal JDW001 disetujui.
Jadwal JDW001 | Waktu: Senin, 08:00-10:00 | Status: disetujui

=== Skenario 2 - Input salah: format id tidak valid ===
Error tertangkap: Id jadwal tidak valid: "JADWAL-X" (format harus seperti JDW001).

=== Skenario 3 - Input salah: waktu kosong ===
Error tertangkap: Waktu jadwal tidak boleh kosong.

=== Skenario 4 - Aturan bisnis: jadwal bentrok tidak boleh disetujui ===
-> Jadwal JDW003 ditandai BENTROK.
Error tertangkap: Jadwal JDW003 bentrok, tidak dapat disetujui.

Catatan: Output di atas merupakan hasil penelusuran kode secara manual. Untuk mendapatkan bukti screenshot yang akan dikumpulkan, jalankan file PHP melalui terminal dengan perintah berikut:

php 20251020022_MuhammadFarridAndaris_PBO_M4.php

E. Explain — Perubahan dan Alasan

Pada tugas Pertemuan 3, semua property dalam class "Jadwal" masih bersifat "public". Artinya, kode dari luar class bisa mengubah nilai "status" atau "waktu" secara langsung tanpa melalui pengecekan. Sebagai contoh, status jadwal bisa langsung diubah menjadi "disetujui", meskipun jadwal tersebut sebenarnya sedang bentrok.

Pada tugas Pertemuan 4, ketiga property diubah menjadi "private". Perubahan data dilakukan melalui method yang sudah disediakan, yaitu "setWaktu()", "setujui()", dan "tandaiBentrok()". Setiap method memiliki pengecekan agar perubahan yang dilakukan tetap sesuai aturan.

Dengan penerapan encapsulation ini, class "Jadwal" dapat menjaga data agar tetap konsisten. Kode dari luar class tidak bisa mengubah property secara langsung, sehingga aturan pengelolaan jadwal dapat diterapkan dengan lebih terkontrol.
