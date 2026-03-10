<?php
session_start();
include __DIR__.'/config/db.php';
$cart = $_SESSION['cart'] ?? [];
$products = [];
if(count($cart)>0){
    $ids = implode(',', array_map('intval', array_keys($cart)));
    $res = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    while($r = $res->fetch_assoc()) $products[$r['id']] = $r;
}
?>
<!doctype html><html><head><meta charset='utf-8'><title>Cart</title><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'><link rel='stylesheet' href='assets/css/style.css'></head><body>
<div class="container my-5">
  <a href="index.php" class="btn btn-sm btn-outline-secondary mb-3">Home</a>
<?php if(empty($cart)): ?>
  <div class="alert alert-info">Cart is empty. <a href="index.php">Shop now</a></div>
<?php else: ?>
  <table class="table"><thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead><tbody>
  <?php $total=0; foreach($cart as $pid=>$q): $p=$products[$pid]; $sub = $p['price']*$q; $total += $sub; ?>
    <tr>
      <td><?= htmlspecialchars($p['title']) ?></td>
      <td>Rs <?= number_format($p['price'],2) ?></td>
      <td><?= $q ?></td>
      <td>Rs <?= number_format($sub,2) ?></td>
      <td><a href="remove_from_cart.php?id=<?= $pid ?>" class="btn btn-sm btn-danger">Remove</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody></table>
  <h4>Total: Rs <?= number_format($total,2) ?></h4>
  <a href="checkout.php" class="btn btn-primary">Checkout</a>
<?php endif; ?>
</div></body></html>
