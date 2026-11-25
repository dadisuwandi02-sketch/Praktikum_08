<?php
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');

class MahasiswaPresenter3 {
    public function __call(string $name, array $args): string {
        if ($name !== 'showData') {
            throw new BadMethodCallException('Unknown method: ' . $name);
        }
        if (count($args) === 3
            && is_string($args[0]) && is_string($args[1]) && is_string($args[2])) {
            return 'NIM: ' . $args[0] . ' | Nama: ' . $args[1] . ' | Prodi: ' . $args[2];
        }
        throw new InvalidArgumentException('Expected 3 string arguments: nim, nama, prodi');
    }
}

function cetak(string $label, callable $fn): void {
    try {
        $hasil = $fn();
    } catch (Throwable $e) {
        $hasil = get_class($e) . ': ' . $e->getMessage();
    }
    echo htmlspecialchars($label . ' -> ' . $hasil) . PHP_EOL;
}

$p = new MahasiswaPresenter3();

echo '<body style="background:#fff;color:#000"><pre>';

cetak('showData("2026001","Rayen","Informatika")', fn() => $p->showData('2026001', 'Rayen', 'Informatika'));
cetak('showData()', fn() => $p->showData());
cetak('showData("Rayen")', fn() => $p->showData('Rayen'));
cetak('showData("2026001","Rayen")', fn() => $p->showData('2026001', 'Rayen'));
cetak('showData("2026001","Rayen",123)', fn() => $p->showData('2026001', 'Rayen', 123));
cetak('showData("a","b","c","d")', fn() => $p->showData('a', 'b', 'c', 'd'));
cetak('hapusData("x")', fn() => $p->hapusData('x'));

echo '</pre></body>';

