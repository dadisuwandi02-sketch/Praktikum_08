<?php
declare(strict_types=1);

// FILE EKSPERIMEN TERPISAH. Jalankan sendiri untuk melihat fatal error.
// Jangan di-require dari index.php karena memang dirancang untuk gagal.

class FinalParent
{
    final public function identify(): string
    {
        return 'Parent';
    }
}

class FinalChild extends FinalParent
{
    // PHP akan menghentikan proses deklarasi class:
    // Cannot override final method FinalParent::identify()
    public function identify(): string
    {
        return 'Child';
    }
}
