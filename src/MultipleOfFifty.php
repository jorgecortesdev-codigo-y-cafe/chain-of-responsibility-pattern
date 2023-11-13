<?php

declare(strict_types=1);

namespace App;

class MultipleOfFifty extends OperationAbstract
{
    public function process(Transaction $transaction): void
    {
        if ($transaction->amount % 50 !== 0) {
            echo "La cantidad debe ser múltiplo de $50\n";
            return;
        }

        $this->next($transaction);
    }
}
