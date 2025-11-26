<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include 'config.php';

$data = json_decode(file_get_contents("php://input"));

if ($data && isset($data->email) && isset($data->mot_de_passe)) {
    $email = $data->email;
    $mot_de_passe = $data->mot_de_passe;

    $sql = "SELECT * FROM users WHERE email = ? AND mot_de_passe = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $mot_de_passe]);
    $user = $stmt->fetch();

    if ($user) {
        echo json_encode(['status' => 'success', 'role' => $user['role']]);
    } else {
        echo json_encode(['status' => 'fail']);
    }
} else {
    echo json_encode(['status' => 'fail']);
}
?>
