<?php
require_once  __DIR__ . '/Card.php';
require_once  __DIR__ . '/Client.php';

class Posnet {
    private string $cardFile = 'cards.json';

    public function __construct() {
        if (!file_exists($this->cardFile)) {
            file_put_contents($this->cardFile, json_encode([]));
        }
    }

    public function newCard(array $data): string {
        if (!isset($data['type'], $data['number'], $data['bank'], $data['limit'], $data['client'])) {
            throw new Exception("Missing card or owner information");
        }

        $clientData = $data['client'];
        $owner = new Client(
             $clientData['name'] ?? '',
            $clientData['lastName'] ?? '',
            $clientData['dni'] ?? ''
        );

        $card = new Card(
            $data['type'],
            (int)$data['number'],
            $data['bank'],
            (int)$data['limit'],
            $owner
        );

        $cards = $this->getCards();
        $cards[] = $card;
        $this->saveCards($cards);

        return "Card registered successfully for {$owner->name} {$owner->lastName}";
    }

    public function doPayment(array $data): array {
        if (!isset($data['cardNumber'], $data['amount'], $data['fees'])) {
            throw new Exception("Missing payment information");
        }

        $cardNumber = $data['cardNumber'];
        $amount = +$data['amount'];
        $fees = +$data['fees'];

        if ($fees < 1 || $fees > 6) {
            throw new Exception("Invalid number of fees (1 to 6 only)");
        }

        $cards = $this->getCards();

        if (empty($cards)) {
            throw new Exception("No cards available for payment.");
        }

        $cardKey = array_search($cardNumber, array_column($cards, 'number'));

        if ($cardKey === false) {
            throw new Exception("Card not found");
        }

        $card = $cards[$cardKey];

        /**
         * @todo see this calculation...
         */
        $surcharge = ($fees > 1) ? $amount * (0.03 * ($fees - 1)) : 0;
        $total = $amount + $surcharge;



        if ($card['limit'] < $total) {
            throw new Exception("Insufficient card limit");
        }

        $cards[$cardKey]['limit'] -= $total;
        $this->saveCards($cards);

        return [
            'client' => "{$card['client']['name']} {$card['client']['lastName']}",
            'total' => $total,
            'feesAmount' => $total / $fees
        ];
    }

   public function getCards(): array {
    if (!file_exists($this->cardFile)) {
        return [];
    }

    $cardsJson = file_get_contents($this->cardFile);
    
    if ($cardsJson === false) {
        throw new Exception("Error reading card data from file");
    }
    
    $cards = json_decode($cardsJson, true);
    
    if ($cards === null) {
        return [];
    }
    
    return $cards;
}

    private function saveCards(array $cards): void {
        file_put_contents($this->cardFile, json_encode($cards));
    }
}
