<?php

declare(strict_types=1);

namespace App;

class OneHundredBillDispenser extends OperationAbstract
{
    public function process(Transaction $transaction): void
    {
        if ($transaction->amount < 100) {
            $this->next($transaction);
            return;
        }

        $bills = (int) ($transaction->amount / 100);
        $remain = $transaction->amount % 100;

        echo "Entrega billetes de $100: {$bills}\n";

        if ($remain !== 0) {
            $transaction->amount = $remain;
            $this->next($transaction);
        }
    }
}
