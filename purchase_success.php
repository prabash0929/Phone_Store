<?php include __DIR__.'/config/db.php'; if(!isset($_GET['id'])) header('Location:index.php'); $id=(int)$_GET['id']; $p = $conn->query('SELECT * FROM purchases WHERE id='.$id)->fetch_assoc(); ?>
<!doctype html><html><head><meta charset='utf-8'><title>Success</title><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'></head><body>
<div class='container my-5'><div class='alert alert-success'>Thank you! Your purchase (ID: <?= $id ?>) was successful.</div><a href='index.php' class='btn btn-primary'>Continue shopping</a></div></body></html>
