<?php

declare(strict_types=1);

namespace Tests;

use App\BalanceChecker;
use App\Transaction;
use PHPUnit\Framework\TestCase;

class BalanceCheckerTest extends TestCase
{
    /** @test */
    public function it_give_you_an_alert_if_you_dont_have_enough_money(): void
    {
        $transaction = new Transaction();
        $transaction->amount = 50;
        $transaction->balance = 0;

        $balanceChecker = new BalanceChecker();

        ob_start();
        $balanceChecker->process($transaction);
        $dump = ob_get_clean();

        $this->assertEquals("No tienes dinero suficiente.\n", $dump);
    }

    /** @test */
    public function it_continue_to_the_next_link_in_the_chain_if_the_balance_is_good(): void
    {
        $transaction = new Transaction();
        $transaction->amount = 50;
        $transaction->balance = 100;

        $balanceChecker = new BalanceChecker();

        ob_start();
        $balanceChecker->process($transaction);
        $dump = ob_get_clean();

        $this->assertEquals('', $dump);
    }
}
