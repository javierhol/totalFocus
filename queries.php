<?php
 require_once 'connect.php';

$conn = getConnect();
function getCartTotal($conn, $userId) {
    $sql = "SELECT SUM(quantity) AS total_products FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['total_products'] ?? 0;
}

function getProducts($conn, $limit, $offset) {
    $sql = "SELECT id, name, price, img FROM products LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $limit, $offset);
    $stmt->execute();
    return $stmt->get_result();
}

function getCartItems($conn, $userId) {
    $query = "
      SELECT cart.quantity, products.id, products.name, products.price, products.img
      FROM cart
      INNER JOIN products ON cart.product_id = products.id
      WHERE cart.user_id = ?";
      
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $cartItems = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $cartItems;
}

function getProductsWhislist($conn, $userId) {
    $query = "
      SELECT products.id, products.name, products.price, products.img
      FROM wishlist
      INNER JOIN products ON wishlist.product_id = products.id
      WHERE wishlist.user_id = ?";
      
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $wishlistItems = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $wishlistItems;
}