<?php
require_once 'connect.php'; // Conexión a la base de datos
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    $conn = getConnect();

    // Obtener la entrada JSON
    $data = json_decode(file_get_contents('php://input'), true);


    if (!$data || !isset($data['paymentInfo']) || !isset($data['cartItems'])) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
        exit;
    }

    $paymentInfo = $data['paymentInfo'];
    $cartItems = $data['cartItems'];

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Procesar cada producto en el carrito
        foreach ($cartItems as $item) {
            $productId = $item['id'];
            $quantityPurchased = $item['quantity'];

            // Verificar si hay stock suficiente
            $queryStock = "SELECT stock FROM products WHERE id = ?";
            $stmt = $conn->prepare($queryStock);
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $stmt->close();

            if (!$product || $product['stock'] < $quantityPurchased) {
                throw new Exception("Stock insuficiente para el producto con ID $productId.");
            }

            // Decrementar el stock
            $queryUpdateStock = "UPDATE products SET stock = stock - ? WHERE id = ?";
            $stmt = $conn->prepare($queryUpdateStock);
            $stmt->bind_param("ii", $quantityPurchased, $productId);
            $stmt->execute();
            $stmt->close();

            // Registrar en la tabla `shipping`
            $queryShipping = "
                INSERT INTO shopping (user_id, address, product_id, quantity, shipping_date)
                VALUES (?, ?, ?, ?, NOW())
            ";
            $stmt = $conn->prepare($queryShipping);
            $stmt->bind_param("isii", $userId, $paymentInfo['address'], $productId, $quantityPurchased);
            $stmt->execute();
            $stmt->close();

            // delete from cart
            $queryDeleteCart = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
            $stmt = $conn->prepare($queryDeleteCart);
            $stmt->bind_param("ii", $userId, $productId);
            $stmt->execute();
            $stmt->close();

            
        }

        // Confirmar la transacción
        $conn->commit();

        // Responder éxito
        echo json_encode(['success' => true, 'message' => 'Compra procesada exitosamente']);
    } catch (Exception $e) {
        // Revertir los cambios si algo falla
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido o usuario no autenticado']);
}
