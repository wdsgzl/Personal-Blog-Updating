<?php
// 获取 POST 数据
$newname = $_POST['sname'];
$newconfig = $_POST['sconfig'];
$newup=$_POST['sup'];
// 连接数据库
$db_file = 'Source.sqlite3';
try {
    $db = new SQLite3($db_file);
} catch (Exception $e) {
    // 连接失败时返回错误信息
    echo json_encode(['success' => false, 'error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}
$sql = "INSERT INTO Deal(name,config,up) VALUES ('$newname', '$newconfig', '$newup')";
$db->exec($sql); 
// 关闭数据库连接
$db->close();
?>
