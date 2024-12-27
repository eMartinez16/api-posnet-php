<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../Card.php';
require_once __DIR__ . '/../Client.php';


class CardTest extends TestCase {

    public function testCardCreation() {        
        $client = new Client('Emiliano', 'Martinez', '12345678');
        $this->assertInstanceOf(Client::class, $client);

        $card = new Card('Visa', 12345678, 'Banco X', 5000, $client); 

        $this->assertInstanceOf(Card::class, $card);
        /** test case of error */

        $this->assertEquals(expected: 1234567, actual: $card->number);
        /** test case of success */
        $this->assertEquals('Banco X', $card->bank);
        /** test case of error */
        $this->assertEquals(10000, $card->limit);
    }

}
