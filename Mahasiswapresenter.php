<?php
declare(strict_types=1);

class MahasiswaPresenter {
    public function __call(string $name, array $args): string {
        if ($name !== 'showData') {
            throw new BadMethodCallException('Unknown method: ' . $name);
        }

        // Pola 1: showData(nama)
        if (count($args) === 1 && is_string($args[0])) {
            return 'Nama: ' . $args[0];
        }

        // Pola 2: showData(nim, nama)
        if (count($args) === 2 && is_string($args[0]) && is_string($args[1])) {
            return 'NIM: ' . $args[0] . ' | Nama: ' . $args[1];
        }

        throw new InvalidArgumentException('Expected 1 or 2 string arguments');
    }
}