<?php
session_start();
include __DIR__.'/config/db.php';
if($_SERVER['REQUEST_METHOD']!=='POST') { header('Location:index.php'); exit; }
$pid = (int)$_POST['product_id'];
$qty = 1;
$stmt = $conn->prepare('SELECT * FROM products WHERE id=?'); $stmt->bind_param('i',$pid); $stmt->execute(); $p = $stmt->get_result()->fetch_assoc();
if(!$p){ header('Location:index.php'); exit; }
$total = $p['price'] * $qty;
$user_id = NULL;
$ins = $conn->prepare('INSERT INTO purchases (user_id, total) VALUES (?,?)'); $ins->bind_param('id',$user_id,$total); $ins->execute();
$purchase_id = $ins->insert_id;
$it = $conn->prepare('INSERT INTO purchase_items (purchase_id, product_id, price, qty) VALUES (?,?,?,?)'); $it->bind_param('iidi',$purchase_id, $pid, $p['price'], $qty); $it->execute();
$conn->query('UPDATE products SET quantity = quantity - '.(int)$qty.' WHERE id='.(int)$pid);
header('Location: purchase_success.php?id='.$purchase_id); exit;
?>