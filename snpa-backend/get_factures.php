<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

include 'config.php';

try {
    $stmt = $pdo->query("SELECT * FROM factures ORDER BY id DESC");
    $factures = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($factures);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
