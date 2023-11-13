<?php

declare(strict_types=1);

namespace App;

class FiftyBillDispenser extends OperationAbstract
{
    public function process(Transaction $transaction): void
    {
        if ($transaction->amount < 50) {
            $this->next($transaction);
            return;
        }

        $bills = (int) ($transaction->amount / 50);
        $remain = $transaction->amount % 50;

        echo "Entrega billetes de $50: {$bills}\n";

        if ($remain !== 0) {
            $transaction->amount = $remain;
            $this->next($transaction);
        }
    }
}
