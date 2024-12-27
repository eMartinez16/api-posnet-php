<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Posnet.php';


class PosnetTest extends TestCase
{
    private $posnet;

    protected function setUp(): void
    {
        $this->posnet = new Posnet();
    }

    public function testGetCardsReturnsEmptyArrayWhenNoCards()
    {
        $cards = $this->posnet->getCards();
        $this->assertIsArray($cards);
        $this->assertEmpty($cards);
    }

    public function testCardLimitCheck()
    {
        $card = [
            "type" => "Visa",
            "number" => 12345678,
            "bank" => "Banco X",
            "limit" => 5000,
            "client" => [
                "name" => "Emiliano",
                "lastName" => "Martinez",
                "dni" => "12345678"
            ]
        ];

        $this->posnet->newCard($card); 

        $paymentAmount = 6000;
        $result = $this->posnet->doPayment([
            "number" => 12345678,
            "amount" => $paymentAmount,
            "installments" => 1
        ]);

        $this->assertFalse($result['success']);
        $this->assertEquals("Insufficient card limit", $result['error']);
    }
}
