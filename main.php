<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\BalanceChecker;
use App\FiftyBillDispenser;
use App\FiveHundredBillDispenser;
use App\MultipleOfFifty;
use App\OneHundredBillDispenser;
use App\Transaction;
use App\TwoHundredBillDispenser;

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

$multiple->process($transaction);
