<?php

require_once 'connect.php';

$data = json_decode(file_get_contents("php://input"), true);

$conn = getConnect();
session_start();

if(isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $productId = $data['id'];

    $sql = "SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'El producto ya está en la lista de deseos']);
    } else {
        $insertSql = "INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ii", $userId, $productId);

        if ($insertStmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Producto agregado a la lista de deseos']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al agregar el producto']);
        }

        $insertStmt->close();
    }

    
    
} else {
    echo 'No hay datos de usuario en el localStorage';
}

?>
