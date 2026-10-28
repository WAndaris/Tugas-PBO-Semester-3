# Tugas Rumah Pertemuan 5 - Mini Application OOP

Nama: Muhammad Farrid Andaris
NIM: 20251020022
Prodi: TI 1/1

## Domain

Domainnya masih sama kayak tugas-tugas sebelumnya, pengelolaan jadwal di BAAK. Dipilih lagi karena udah dianalisis dari Pertemuan 2 sampai 4, jadi tinggal dikembangin ke bagian inheritance, interface, sama composition sesuai materi minggu ini.

## Masalah

Intinya sama kayak dari awal: penjadwalan masih manual, gampang bentrok antar ruang atau dosen yang kepake di jam yang sama, dan belum ada pengecekan otomatis. Yang beda di tugas ini saya coba modelin lebih detail terutama soal ruangnya, soalnya ternyata ruang kelas biasa sama ruang lab itu beda. Ruang lab punya jumlah komputer yang jadi batasan kapasitas, sedangkan ruang kelas cuma soal jumlah kursi. Dari situ kelihatan ada hubungan "is-a" yang jelas: RuangKelas dan RuangLab sama-sama Ruang, cuma detailnya beda-beda.

## Desain

Class yang dipakai: MataKuliah, Ruang (abstract), RuangKelas, RuangLab, Dosen, dan Jadwal. Jadi kalau dihitung ada 6 class, lebih dari cukup dari minimal 4 yang diminta.

**Inheritance** — Ruang dibikin abstract, ada method `kapasitasMaksimal()` yang wajib diisi tiap turunannya. RuangKelas nilainya tetap 40, RuangLab ngikut jumlah komputer yang dimasukin pas objeknya dibuat. Method `info()` juga di-override di RuangLab biar infonya nambahin jumlah komputer, nggak cuma nama sama kapasitas kayak di induknya.

**Interface** — dibikin `DapatDicekKetersediaan` yang isinya satu method, `cekKetersediaan()`. Diimplementasikan sama Ruang (otomatis nurun ke RuangKelas & RuangLab) dan juga sama Dosen. Alasannya Ruang dan Dosen itu dua hal yang sama sekali nggak ada hubungan turunan, tapi sama-sama punya "kemampuan" yang sama, bisa dicek kosong atau nggak di jam tertentu. Makanya dipilih interface buat relasi ini, bukan inheritance.

**Composition** — ada di class Jadwal. Satu object Jadwal itu terdiri dari satu MataKuliah, satu Ruang, dan satu Dosen, jadi hubungannya "has-a". Jadwal nggak mewarisi apa-apa dari ketiganya, cuma nyimpen dan makein objek-objek itu buat ngecek bentrok lewat method `ajukan()`.

**Polymorphism** — kelihatan waktu saya loop dua jenis Ruang (RuangKelas sama RuangLab) terus manggil `tampilkanInfoRuang()` yang sama buat dua-duanya, tanpa if/else buat beda-bedain jenis ruangnya. Hasilnya otomatis beda sesuai object aslinya.

## Pengujian

Ada 3 skenario yang dijalankan:
1. Pengajuan jadwal normal -> berhasil, status jadi disetujui.
2. Ruang yang sama dipakai dua kali di jam yang sama -> bentrok.
3. Dosen yang sama ngajar di jam beda pakai ruang lab -> tetap berhasil, soalnya waktunya beda dan ruangnya juga beda.

Ketiganya kelihatan di output program (lihat file screenshot / hasil run).

## Kenapa nggak semuanya pakai inheritance

Sempat kepikiran mau bikin MataKuliah atau Dosen diturunin dari sesuatu juga, tapi menurut saya nggak ada hubungan "is-a" yang jelas di situ, jadi malah dipaksain. Ini juga yang diingetin di materi minggu ini, jangan bikin inheritance cuma karena pengen dipakai, harus liat dulu apa relasinya masuk akal atau nggak buat domainnya.
