<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include 'config.php';

$data = json_decode(file_get_contents("php://input"));

if ($data) {
    $code_article = $data->code_article;     
    $designation = $data->designation;
    $qualite = $data->qualite;
    $couleur = $data->couleur;
    $grammage = $data->grammage;
    $format = $data->format;
    $prix_unitaire = $data->prix_unitaire;
    

    $sql = "INSERT INTO articles (code_article, designation, qualite, couleur, grammage, format, prix_unitaire) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $code_article,
        $designation,
        $qualite,
        $couleur,
        $grammage,
        $format,
        $prix_unitaire
    ]);

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "fail"]);
}
?>
