<?php

require_once 'connect.php';

$data = json_decode(file_get_contents("php://input"), true);

$conn = getConnect();
session_start();

if(isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];
    $productId = $data['id'];
    $quantity = 1;

    // Verificar si el producto ya está en el carrito
    $sql = "SELECT amount FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Si ya existe, obtener la cantidad actual y actualizarla
        $stmt->bind_result($currentAmount);
        $stmt->fetch();
        $newAmount = $currentAmount + $amount;

        $updateSql = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("iii", $newAmount, $userId, $productId);

        if ($updateStmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Cantidad actualizada']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la cantidad']);
        }

        $updateStmt->close();
    } else {
        // Si no existe, insertar un nuevo registro
        $insertSql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("iii", $userId, $productId, $quantity);

        if ($insertStmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Producto agregado al carrito']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al agregar el producto']);
        }

        $insertStmt->close();
    }

    $stmt->close();
} else {
    echo 'No hay datos de usuario en el localStorage';
}

?>
