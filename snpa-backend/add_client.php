<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include("db.php");

$data = json_decode(file_get_contents("php://input"), true);

if (
    !empty($data["nom"]) &&
    !empty($data["prenom"]) &&
    !empty($data["adresse"]) &&
    !empty($data["code_tva"])
) {
    $nom = mysqli_real_escape_string($conn, $data["nom"]);
    $prenom = mysqli_real_escape_string($conn, $data["prenom"]);
    $adresse = mysqli_real_escape_string($conn, $data["adresse"]);
    $code_tva = mysqli_real_escape_string($conn, $data["code_tva"]);

    $queryLastId = "SELECT MAX(id) AS max_id FROM clients";
    $result = mysqli_query($conn, $queryLastId);
    $row = mysqli_fetch_assoc($result);
    $lastId = $row["max_id"] ?? 0;
    $newId = $lastId + 1;
    $code_client = "CLT" . str_pad($newId, 3, "0", STR_PAD_LEFT); // Ex: CLT0001

    $sql = "INSERT INTO clients (code_client, nom, prenom, adresse, code_tva) 
            VALUES ('$code_client', '$nom', '$prenom', '$adresse', '$code_tva')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(["success" => true, "message" => "Client ajouté avec succès", "code_client" => $code_client]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur : " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Données incomplètes"]);
}
?>
