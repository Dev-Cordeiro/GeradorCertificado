<?php
require 'db.php';

$sql = "SELECT nome, curso, DATE_FORMAT(data_emissao, '%Y-%m-%d') as data_emissao, arquivo_url FROM Certificados";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$certificados = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($certificados);
?>