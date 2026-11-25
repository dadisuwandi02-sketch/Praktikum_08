<?php
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');

require_once __DIR__ . '/MahasiswaReguler.php';
require_once __DIR__ . '/MahasiswaBeasiswa.php';
require_once __DIR__ . '/MahasiswaPresenter.php';

class Calculator {
    public function add(int ...$numbers): int {
        return array_sum($numbers);
    }
}

// Mengembalikan hasil, atau nama class exception jika dilempar
function jalankan(callable $fn): string {
    try {
        return (string) $fn();
    } catch (Throwable $e) {
        return get_class($e);
    }
}

function uji(string $id, string $diharapkan, callable $fn): void {
    $aktual = jalankan($fn);
    $status = ($aktual === $diharapkan) ? 'Lulus' : 'Gagal';
    echo htmlspecialchars("$id: $aktual [$status]") . PHP_EOL;
}

$calc = new Calculator();
$p = new MahasiswaPresenter();

$r = new MahasiswaReguler('M01', 'Alya', 'FST', 'Informatika', 'SMA 1', 3, 'Membaca', 'Islam', 5000000);
$b = new MahasiswaBeasiswa('M02', 'Bima', 'FST', 'Informatika', 'SMA 2', 3, 'Coding', 'Islam', 5000000, 40);
$buat = fn(int $pot) => new MahasiswaBeasiswa('M03', 'C', 'FST', 'Informatika', 'SMA', 3, 'x', 'Islam', 5000000, $pot);

echo '<body style="background:#fff;color:#000"><pre>';

uji('T01', '30 dan 60', fn() => $calc->add(10, 20) . ' dan ' . $calc->add(10, 20, 30));
uji('T02', 'Name: Ahmad', fn() => $p->showData('Ahmad'));
uji('T03', 'ID: 2026001 | Name: Ahmad', fn() => $p->showData('2026001', 'Ahmad'));
uji('T04', 'InvalidArgumentException', fn() => $p->showData());
uji('T05', 'BadMethodCallException', fn() => $p->hapusData('x'));
uji('T06', '5000000', fn() => $r->hitungBiaya());
uji('T07', '3000000', fn() => $b->hitungBiaya());
uji('T08a', 'InvalidArgumentException', fn() => $buat(-1));
uji('T08b', 'InvalidArgumentException', fn() => $buat(101));
uji('T09', 'M01 - Alya | M02 - Bima [Beasiswa 40%]', fn() => $r->ringkasan() . ' | ' . $b->ringkasan());

echo '</pre></body>';