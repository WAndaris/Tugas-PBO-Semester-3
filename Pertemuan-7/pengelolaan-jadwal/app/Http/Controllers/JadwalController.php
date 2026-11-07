<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class JadwalController extends Controller
{
    // Halaman daftar jadwal
    public function index()
    {
        $judulHalaman = 'Daftar Jadwal Perkuliahan';
        $daftarJadwal = $this->dataJadwal();

        return view('jadwal.index', compact(
            'judulHalaman',
            'daftarJadwal'
        ));
    }

    // Halaman detail jadwal berdasarkan ID
    public function show(string $id)
    {
        $jadwal = null;

        foreach ($this->dataJadwal() as $item) {
            if ((string) $item['id'] === $id) {
                $jadwal = $item;
                break;
            }
        }

        return view('jadwal.show', compact('id', 'jadwal'));
    }

    // Halaman jadwal berdasarkan dosen
    public function perDosen(string $slug)
    {
        $jadwalDosen = array_values(array_filter(
            $this->dataJadwal(),
            fn ($item) => $item['dosen_slug'] === $slug
        ));

        $namaDosen = $jadwalDosen[0]['dosen']
            ?? ucwords(str_replace('-', ' ', $slug));

        return view('jadwal.dosen', compact(
            'namaDosen',
            'jadwalDosen'
        ));
    }

    // Data contoh jadwal
    private function dataJadwal(): array
    {
        $data = [
            [
                'id' => 1,
                'matkul' => 'Pemrograman Berorientasi Objek',
                'dosen' => 'Hilman Lesmana, M.S.F.',
                'ruang' => 'Lab Komputer 1',
                'waktu' => 'Senin, 08:00-10:00',
                'status' => 'disetujui',
            ],
            [
                'id' => 2,
                'matkul' => 'Statistik for Data Science',
                'dosen' => 'Verina Tita Nabila, M.Si.',
                'ruang' => 'Ruang Kelas 201',
                'waktu' => 'Senin, 10:00-12:00',
                'status' => 'disetujui',
            ],
            [
                'id' => 3,
                'matkul' => 'Administrasi Jaringan Komputer',
                'dosen' => 'Unang Solihin, M.Kom.',
                'ruang' => 'Lab Komputer 1',
                'waktu' => 'Senin, 08:00-10:00',
                'status' => 'bentrok',
            ],
            [
                'id' => 4,
                'matkul' => 'Teknik Multimedia',
                'dosen' => 'Dzulfiqar Fickri Rosyid, M.Ds.',
                'ruang' => 'Ruang Kelas 201',
                'waktu' => 'Selasa, 10:00-12:00',
                'status' => 'diajukan',
            ],
            [
                'id' => 5,
                'matkul' => 'Manajemen Data & Informasi',
                'dosen' => 'Petrus Sokibi, M.Kom.',
                'ruang' => 'Ruang Kelas 202',
                'waktu' => 'Rabu, 13:00-15:00',
                'status' => 'disetujui',
            ],
        ];

        return array_map(function ($item) {
            $item['dosen_slug'] = Str::slug($item['dosen']);
            return $item;
        }, $data);
    }
}