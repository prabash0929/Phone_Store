<?php
header('Content-Type: application/json');
include __DIR__.'/config/db.php';
$labels=[];$values=[];
for($i=6;$i>=0;$i--){
    $d = date('Y-m-d', strtotime("-$i days"));
    $labels[] = $d;
    $stmt = $conn->prepare("SELECT COALESCE(SUM(total),0) as s FROM purchases WHERE DATE(created_at)=?");
    $stmt->bind_param('s',$d);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();
    $values[] = (float)$res['s'];
}
echo json_encode(['labels'=>$labels,'values'=>$values]);
?>