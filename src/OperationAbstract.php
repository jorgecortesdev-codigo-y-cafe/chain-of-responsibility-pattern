<?php

declare(strict_types=1);

namespace App;

abstract class OperationAbstract
{
    protected OperationAbstract $operation;

    public function then(OperationAbstract $operation): void
    {
        $this->operation = $operation;
    }

    public function next(Transaction $transaction): void
    {
        if (isset($this->operation)) {
            $this->operation->process($transaction);
        }
    }

    abstract public function process(Transaction $transaction): void;
}
