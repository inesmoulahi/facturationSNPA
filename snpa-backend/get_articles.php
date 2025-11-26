<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include 'config.php';

$stmt = $pdo->query("SELECT * FROM articles");
$articles = $stmt->fetchAll();
echo json_encode($articles);
?>
