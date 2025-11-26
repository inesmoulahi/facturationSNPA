<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include 'config.php';

$data = json_decode(file_get_contents("php://input"));

$sql = "INSERT INTO bon_livraison (numero_bon, lieu, date_bon, mode_paiement, mode_transport, client_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $data->numero_bon,
    $data->lieu,
    $data->date_bon,
    $data->mode_paiement,
    $data->mode_transport,
    $data->client_id
]);

$bon_id = $pdo->lastInsertId();

foreach ($data->details as $detail) {
    $sql_detail = "INSERT INTO bon_livraison_detail (bon_livraison_id, article_id, nombre_bobines, tonnage) VALUES (?, ?, ?, ?)";
    $stmt_detail = $pdo->prepare($sql_detail);
    $stmt_detail->execute([$bon_id, $detail->article_id, $detail->nombre_bobines, $detail->tonnage]);
}

echo json_encode(["status" => "success", "bon_id" => $bon_id]);
?>
