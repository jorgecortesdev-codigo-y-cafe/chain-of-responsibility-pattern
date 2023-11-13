<?php

declare(strict_types=1);

namespace Tests;

use App\BalanceChecker;
use App\FiftyBillDispenser;
use App\FiveHundredBillDispenser;
use App\MultipleOfFifty;
use App\OneHundredBillDispenser;
use App\Transaction;
use App\TwoHundredBillDispenser;
use PHPUnit\Framework\TestCase;

class ChainTest extends TestCase
{
    /** @test */
    public function it_can_chain_multiple_operations(): void
    {
        $transaction = new Transaction();
        $transaction->amount = 1350;
        $transaction->balance = 5000;

        $multiple = new MultipleOfFifty();
        $balance = new BalanceChecker();
        $fiveHundred = new FiveHundredBillDispenser();
        $twoHundred = new TwoHundredBillDispenser();
        $oneHundred = new OneHundredBillDispenser();
        $fifty = new FiftyBillDispenser();

        $multiple->then($balance);
        $balance->then($fiveHundred);
        $fiveHundred->then($twoHundred);
        $twoHundred->then($oneHundred);
        $oneHundred->then($fifty);

        ob_start();
        $multiple->process($transaction);
        $dump = ob_get_clean();

        $expectedDump = <<<TXT
Entrega billetes de $500: 2
Entrega billetes de $200: 1
Entrega billetes de $100: 1
Entrega billetes de $50: 1

TXT;

        $this->assertEquals($expectedDump, $dump);
    }
}
