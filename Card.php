<?php
require_once __DIR__ . '/Client.php';


class Card {
    public string $type;
    public int $number;
    public string $bank;
    public int $limit;
    public Client $client;

    public function __construct(string $type, int $number, string $bank, int $limit, Client $client) {
        if (!in_array($type, ['Visa', 'AMEX'])) {
            throw new Exception("Card type not supported");
        }
        if (!preg_match('/^\d{8}$/', (string)$number)) {
            throw new Exception("Card number must be 8 digits long");
        }

        $this->type = $type;
        $this->number = $number;
        $this->bank = $bank;
        $this->limit = $limit;
        $this->client = $client;
    }
}
