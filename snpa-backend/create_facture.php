<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include 'config.php';

$data = json_decode(file_get_contents("php://input"));

$sql = "INSERT INTO facture (bon_livraison_id, nom_prenom, matricule_fiscale, date_facture, lieu, total_ht, total_tva, total_ttc) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    $data->bon_livraison_id,
    $data->nom_prenom,
    $data->matricule_fiscale,
    $data->date_facture,
    $data->lieu,
    $data->total_ht,
    $data->total_tva,
    $data->total_ttc
]);

$facture_id = $pdo->lastInsertId();

foreach ($data->details as $detail) {
    $sql_detail = "INSERT INTO facture_detail (facture_id, designation, quantite, prix_unitaire_ht, montant_ht, taux_tva, montant_tva) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_detail = $pdo->prepare($sql_detail);
    $stmt_detail->execute([
        $facture_id,
        $detail->designation,
        $detail->quantite,
        $detail->prix_unitaire_ht,
        $detail->montant_ht,
        $detail->taux_tva,
        $detail->montant_tva
    ]);
}

echo json_encode(["status" => "success", "facture_id" => $facture_id]);
?>
