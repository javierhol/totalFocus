<?php

require_once 'connect.php';

$data = json_decode(file_get_contents("php://input"), true);

$conn = getConnect();

session_start();

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    $productId = $data['id'];

    $sql = "DELETE FROM wishlist WHERE user_id = ? AND product_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ii", $userId, $productId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Producto eliminado de la lista de deseos']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto']);
    }
} else {
    echo 'No hay datos de usuario en el localStorage';
}


?>