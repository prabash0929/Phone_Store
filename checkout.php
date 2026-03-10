<?php
session_start();
include __DIR__.'/config/db.php';
$cart = $_SESSION['cart'] ?? [];
if(empty($cart)){ header('Location: cart.php'); exit; }
$ids = implode(',', array_map('intval', array_keys($cart)));
$res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
$total = 0; $items = [];
while($p = $res->fetch_assoc()){
    $qty = (int)$cart[$p['id']];
    $total += $p['price'] * $qty;
    $items[] = ['product_id'=>$p['id'],'qty'=>$qty,'price'=>$p['price']];
}
$user_id = NULL;
$stmt = $conn->prepare('INSERT INTO purchases (user_id, total) VALUES (?,?)');
$stmt->bind_param('id', $user_id, $total);
$stmt->execute();
$purchase_id = $stmt->insert_id;
foreach($items as $it){
    $s = $conn->prepare('INSERT INTO purchase_items (purchase_id, product_id, price, qty) VALUES (?,?,?,?)');
    $s->bind_param('iidi', $purchase_id, $it['product_id'], $it['price'], $it['qty']);
    $s->execute();
    $conn->query('UPDATE products SET quantity = quantity - '.(int)$it['qty'].' WHERE id='.(int)$it['product_id']);
}
unset($_SESSION['cart']);
header('Location: purchase_success.php?id='.$purchase_id); exit;
?>