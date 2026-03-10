<?php
session_start();
include __DIR__.'/config/db.php';
$pid = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$qty = isset($_POST['qty']) ? max(1,(int)$_POST['qty']) : 1;
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if($pid>0){
    if(isset($_SESSION['cart'][$pid])) $_SESSION['cart'][$pid] += $qty;
    else $_SESSION['cart'][$pid] = $qty;
}
header('Location: cart.php'); exit;
?>