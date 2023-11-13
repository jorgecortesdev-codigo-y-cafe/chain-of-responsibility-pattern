<?php

declare(strict_types=1);

namespace App;

class BalanceChecker extends OperationAbstract
{
    public function process(Transaction $transaction): void
    {
        if ($transaction->balance < $transaction->amount) {
            echo "No tienes dinero suficiente.\n";
            return;
        }

        $this->next($transaction);
    }
}
