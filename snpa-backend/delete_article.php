<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Content-Type: application/json");

include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM articles WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$id])) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "fail", "error" => $stmt->errorInfo()]);
    }
} else {
    echo json_encode(["status" => "fail", "message" => "ID non fourni"]);
}
?>
