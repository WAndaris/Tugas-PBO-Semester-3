<?php


class Jadwal
{
    
    private string $id;
    private string $waktu;
    private string $status;

    public function __construct(string $id, string $waktu, string $status = "diajukan")
    {
        $this->setId($id);
        $this->setWaktu($waktu);
        $this->status = $status;
    }

    private function setId(string $id): void
    {
        if (!preg_match('/^JDW\d{3,}$/', $id)) {
            throw new InvalidArgumentException(
                "Id jadwal tidak valid: \"{$id}\" (format harus seperti JDW001)."
            );
        }
        $this->id = $id;
    }

    public function setWaktu(string $waktu): void
    {
        if (trim($waktu) === "") {
            throw new InvalidArgumentException("Waktu jadwal tidak boleh kosong.");
        }
        $this->waktu = $waktu;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getWaktu(): string
    {
        return $this->waktu;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function tampilkanInfo(): void
    {
        echo "Jadwal {$this->id} | Waktu: {$this->waktu} | Status: {$this->status}" . PHP_EOL;
    }

   
    public function setujui(): void
    {
        if ($this->status === "bentrok") {
            throw new RuntimeException("Jadwal {$this->id} bentrok, tidak dapat disetujui.");
        }
        $this->status = "disetujui";
        echo "-> Jadwal {$this->id} disetujui." . PHP_EOL;
    }

   
    public function tandaiBentrok(): void
    {
        if ($this->status === "disetujui") {
            throw new RuntimeException("Jadwal {$this->id} sudah disetujui, tidak bisa ditandai bentrok.");
        }
        $this->status = "bentrok";
        echo "-> Jadwal {$this->id} ditandai BENTROK." . PHP_EOL;
    }
}

function judul(string $teks): void
{
    echo PHP_EOL . "=== {$teks} ===" . PHP_EOL;
}


judul("Skenario 1 - Normal: setujui jadwal valid");
try {
    $jadwal1 = new Jadwal("JDW001", "Senin, 08:00-10:00");
    $jadwal1->tampilkanInfo();
    $jadwal1->setujui();
    $jadwal1->tampilkanInfo();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}


judul("Skenario 2 - Input salah: format id tidak valid");
try {
    $jadwalSalah = new Jadwal("JADWAL-X", "Selasa, 10:00-12:00");
    $jadwalSalah->tampilkanInfo();
} catch (Exception $e) {
    echo "Error tertangkap: " . $e->getMessage() . PHP_EOL;
}


judul("Skenario 3 - Input salah: waktu kosong");
try {
    $jadwalKosong = new Jadwal("JDW002", "");
    $jadwalKosong->tampilkanInfo();
} catch (Exception $e) {
    echo "Error tertangkap: " . $e->getMessage() . PHP_EOL;
}


judul("Skenario 4 - Aturan bisnis: jadwal bentrok tidak boleh disetujui");
try {
    $jadwal2 = new Jadwal("JDW003", "Rabu, 13:00-15:00");
    $jadwal2->tandaiBentrok();
    $jadwal2->setujui(); 
} catch (Exception $e) {
    echo "Error tertangkap: " . $e->getMessage() . PHP_EOL;
}
