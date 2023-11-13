<?php

declare(strict_types=1);

namespace App;

class TwoHundredBillDispenser extends OperationAbstract
{
    public function process(Transaction $transaction): void
    {
        if ($transaction->amount < 200) {
            $this->next($transaction);
            return;
        }

        $bills = (int) ($transaction->amount / 200);
        $remain = $transaction->amount % 200;

        echo "Entrega billetes de $200: {$bills}\n";

        if ($remain !== 0) {
            $transaction->amount = $remain;
            $this->next($transaction);
        }
    }
}
