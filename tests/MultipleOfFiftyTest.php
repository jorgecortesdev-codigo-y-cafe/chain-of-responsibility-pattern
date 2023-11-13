<?php

declare(strict_types=1);

namespace Tests;

use App\MultipleOfFifty;
use App\Transaction;
use PHPUnit\Framework\TestCase;

class MultipleOfFiftyTest extends TestCase
{
    /** @test */
    public function it_can_detect_if_the_amount_is_not_multiple_of_50(): void
    {
        $transaction = new Transaction();
        $transaction->amount = 55;

        $multiple = new MultipleOfFifty();

        ob_start();
        $multiple->process($transaction);
        $dump = ob_get_clean();

        $this->assertEquals("La cantidad debe ser múltiplo de $50\n", $dump);
    }

    /** @test */
    public function it_continue_to_the_next_link_in_the_chain_if_the_amount_is_multiple_of_50(): void
    {
        $transaction = new Transaction();
        $transaction->amount = 50;

        $multiple = new MultipleOfFifty();

        ob_start();
        $multiple->process($transaction);
        $dump = ob_get_clean();

        $this->assertEquals('', $dump);
    }
}
