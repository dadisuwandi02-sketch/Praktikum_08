<?php
declare(strict_types=1);
require_once __DIR__ . '/Mahasiswa.php';

final class MahasiswaInternasional extends Mahasiswa {
    private int $ukt;
    private int $biayaTambahan;

    public function __construct(
        string $nim, string $nama, string $fakultas, string $prodi,
        string $asalSekolah, int $semester, string $hobi, string $agama,
        int $ukt, int $biayaTambahan
    ) {
        parent::__construct($nim, $nama, $fakultas, $prodi, $asalSekolah, $semester, $hobi, $agama);
        if ($ukt < 0 || $biayaTambahan < 0) {
            throw new InvalidArgumentException("UKT dan biaya tambahan tidak boleh negatif");
        }
        $this->ukt = $ukt;
        $this->biayaTambahan = $biayaTambahan;
    }

    public function getUkt(): int { return $this->ukt; }
    public function getBiayaTambahan(): int { return $this->biayaTambahan; }

    public function hitungBiaya(): int { return $this->ukt + $this->biayaTambahan; }
    public function getJenis(): string { return 'Internasional'; }

    // Overriding method parent dengan memanfaatkan parent::
    public function ringkasan(): string {
        return parent::ringkasan() . ' [Internasional]';
    }
}