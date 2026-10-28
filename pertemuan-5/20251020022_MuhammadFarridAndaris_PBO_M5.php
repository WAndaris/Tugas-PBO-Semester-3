<?php


interface DapatDicekKetersediaan
{
    public function cekKetersediaan(string $waktu): bool;
}


abstract class Ruang implements DapatDicekKetersediaan
{
    protected string $kode;
    protected string $nama;
    protected array $jadwalTerpakai = [];

    public function __construct(string $kode, string $nama)
    {
        $this->kode = $kode;
        $this->nama = $nama;
    }

  
    abstract public function kapasitasMaksimal(): int;

    public function cekKetersediaan(string $waktu): bool
    {
        return !in_array($waktu, $this->jadwalTerpakai, true);
    }

    public function pakai(string $waktu): void
    {
        $this->jadwalTerpakai[] = $waktu;
    }

    public function info(): string
    {
        return "{$this->nama} ({$this->kode}), kapasitas {$this->kapasitasMaksimal()} orang";
    }
}


class RuangKelas extends Ruang
{
    public function kapasitasMaksimal(): int
    {
        return 40;
    }
}

class RuangLab extends Ruang
{
    private int $jumlahKomputer;

    public function __construct(string $kode, string $nama, int $jumlahKomputer)
    {
        parent::__construct($kode, $nama);
        $this->jumlahKomputer = $jumlahKomputer;
    }

    public function kapasitasMaksimal(): int
    {
        return $this->jumlahKomputer;
    }

    public function info(): string
    {
        return parent::info() . ", tersedia {$this->jumlahKomputer} unit komputer";
    }
}


class Dosen implements DapatDicekKetersediaan
{
    private string $nip;
    private string $nama;
    private array $jadwalMengajar = [];

    public function __construct(string $nip, string $nama)
    {
        $this->nip = $nip;
        $this->nama = $nama;
    }

    public function cekKetersediaan(string $waktu): bool
    {
        return !in_array($waktu, $this->jadwalMengajar, true);
    }

    public function tambahJadwalMengajar(string $waktu): void
    {
        $this->jadwalMengajar[] = $waktu;
    }

    public function getNama(): string
    {
        return $this->nama;
    }
}

class MataKuliah
{
    private string $kode;
    private string $nama;
    private int $sks;

    public function __construct(string $kode, string $nama, int $sks)
    {
        $this->kode = $kode;
        $this->nama = $nama;
        $this->sks = $sks;
    }

    public function getNama(): string
    {
        return $this->nama;
    }
}


class Jadwal
{
    private MataKuliah $mataKuliah;
    private Ruang $ruang;
    private Dosen $dosen;
    private string $waktu;
    private string $status = "diajukan";

    public function __construct(MataKuliah $mataKuliah, Ruang $ruang, Dosen $dosen, string $waktu)
    {
        $this->mataKuliah = $mataKuliah;
        $this->ruang = $ruang;
        $this->dosen = $dosen;
        $this->waktu = $waktu;
    }

    public function ajukan(): bool
    {
        if (!$this->ruang->cekKetersediaan($this->waktu) || !$this->dosen->cekKetersediaan($this->waktu)) {
            $this->status = "bentrok";
            return false;
        }

        $this->ruang->pakai($this->waktu);
        $this->dosen->tambahJadwalMengajar($this->waktu);
        $this->status = "disetujui";
        return true;
    }

    public function info(): string
    {
        return "{$this->mataKuliah->getNama()} | {$this->waktu} | {$this->ruang->info()} "
            . "| Dosen: {$this->dosen->getNama()} | Status: {$this->status}";
    }
}


function tampilkanInfoRuang(Ruang $ruang): void
{
    echo $ruang->info() . PHP_EOL;
}

function judul(string $teks): void
{
    echo PHP_EOL . "=== {$teks} ===" . PHP_EOL;
}


$pbo = new MataKuliah("TI033015", "Pemrograman Berorientasi Objek", 3);
$basisData = new MataKuliah("TI033010", "Basis Data", 3);

$ruangKelas = new RuangKelas("RK-201", "Ruang Kelas 201");
$ruangLab = new RuangLab("LAB-01", "Lab Komputer 1", 25);

$dosenHilman = new Dosen("D001", "Hilman Lesmana");


judul("Polymorphism - info tiap ruang");
foreach ([$ruangKelas, $ruangLab] as $ruang) {
    tampilkanInfoRuang($ruang);
}


judul("Skenario 1 - Pengajuan jadwal normal");
$jadwal1 = new Jadwal($pbo, $ruangKelas, $dosenHilman, "Senin, 08:00-10:00");
$jadwal1->ajukan();
echo $jadwal1->info() . PHP_EOL;


judul("Skenario 2 - Ruang bentrok");
$jadwal2 = new Jadwal($basisData, $ruangKelas, $dosenHilman, "Senin, 08:00-10:00");
$jadwal2->ajukan();
echo $jadwal2->info() . PHP_EOL;


judul("Skenario 3 - Dosen sama, waktu beda, ruang lab");
$jadwal3 = new Jadwal($basisData, $ruangLab, $dosenHilman, "Selasa, 10:00-12:00");
$jadwal3->ajukan();
echo $jadwal3->info() . PHP_EOL;
