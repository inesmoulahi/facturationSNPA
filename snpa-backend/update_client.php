<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include 'db.php';
$data = json_decode(file_get_contents("php://input"), true);

$sql = "UPDATE clients SET nom=?, prenom=?, adresse=?, code_tva=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $data['nom'], $data['prenom'], $data['adresse'], $data['code_tva'], $data['id']);
$stmt->execute();
echo json_encode(["status" => "ok"]);
?>
