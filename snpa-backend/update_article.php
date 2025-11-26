<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include 'config.php';

$data = json_decode(file_get_contents("php://input"));

if ($data && isset($data->id)) {
    $id = $data->id;
    $designation = $data->designation;
    $code_article = $data->code_article;
    $qualite = $data->qualite;
    $couleur = $data->couleur;
    $grammage = $data->grammage;
    $format = $data->format;
    $prix_unitaire = $data->prix_unitaire;

    $sql = "UPDATE articles 
            SET designation = ?, 
                code_article = ?, 
                qualite = ?, 
                couleur = ?, 
                grammage = ?, 
                format = ?, 
                prix_unitaire = ?
            WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $designation,
        $code_article,
        $qualite,
        $couleur,
        $grammage,
        $format,
        $prix_unitaire,
        $id
    ]);

    echo json_encode(["status" => "success", "message" => "Article mis à jour avec succès."]);
} else {
    echo json_encode(["status" => "fail", "message" => "ID manquant ou données invalides."]);
}
?>
