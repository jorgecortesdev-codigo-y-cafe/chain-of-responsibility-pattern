<?php

declare(strict_types=1);

namespace Tests;

use App\FiftyBillDispenser;
use App\Transaction;
use PHPUnit\Framework\TestCase;

class FiftyBillDispenserTest extends TestCase
{
    /** @test */
    public function it_continue_to_the_next_link_in_the_chain_if_no_50_bills_needs_to_be_dispensed(): void
    {
        $transaction = new Transaction();
        $transaction->amount = 40;

        $dispenser = new FiftyBillDispenser();

        ob_start();
        $dispenser->process($transaction);
        $dump = ob_get_clean();

        $this->assertEquals('', $dump);
    }

    /** @test */
    public function it_gives_you_a_message_with_the_number_of_bills(): void
    {
        $transaction = new Transaction();
        $transaction->amount = 100;

        $dispenser = new FiftyBillDispenser();

        ob_start();
        $dispenser->process($transaction);
        $dump = ob_get_clean();

        $this->assertEquals("Entrega billetes de $50: 2\n", $dump);
    }
}
