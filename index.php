<?php
require_once  __DIR__ . '/Card.php';
require_once  __DIR__ . '/Posnet.php';

header('Content-Type: application/json');

try {
    $request = json_decode(file_get_contents('php://input'), true);
    $endpoint = $_GET['endpoint'] ?? '';

    $posnet = new Posnet();

    if ($endpoint === 'newCard') {
        $response = $posnet->newCard($request);
    } elseif ($endpoint === 'processPayment') {
        $response = $posnet->doPayment($request);
    } else {
        throw new Exception('Not found');
    }

    echo json_encode(['success' => true, 'data' => $response]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
