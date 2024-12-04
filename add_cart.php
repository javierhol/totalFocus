<?php

require_once 'connect.php';

$data = json_decode(file_get_contents("php://input"), true);
$conn = getConnect();
session_start();

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $productId = $data['id'];
    $origin = $data['origin'] ?? "product";
    $quantity = 1;

    // Verificar si el producto ya está en el carrito
    $sql = "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($currentAmount);
        $stmt->fetch();
        $newAmount = $currentAmount + $quantity;

        $updateSql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("iii", $newAmount, $userId, $productId);

        if ($updateStmt->execute()) {
            $success = true;
        } else {
            $success = false;
        }

        $updateStmt->close();
    } else {
        $insertSql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("iii", $userId, $productId, $quantity);

        $success = $insertStmt->execute();
        $insertStmt->close();
    }

    $stmt->close();

    // Si viene de la lista de deseos, eliminarlo de ahí
    if ($success && $origin === "wishlist") {
        $deleteSql = "DELETE FROM wishlist WHERE user_id = ? AND product_id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("ii", $userId, $productId);
        $deleteStmt->execute();
        $deleteStmt->close();
    }

    echo json_encode(['success' => $success]);
} else {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
}


?>