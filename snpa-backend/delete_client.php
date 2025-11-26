<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");
include 'db.php';
$id = $_GET['id'];

$sql = "DELETE FROM clients WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
echo json_encode(["status" => "deleted"]);
?>
