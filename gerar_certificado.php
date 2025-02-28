<?php
require 'vendor/autoload.php';
require 'db.php';
use Dompdf\Dompdf;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? 'Nome Padrão';
    $curso = $_POST['curso'] ?? 'Curso Padrão';
    $download = $_POST['download'] ?? 'false';
    
    $dompdf = new Dompdf();
    ob_start();
    include 'Template/certificado.php';
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $nomeArquivo = "certificado_{$nome}_{$curso}.pdf";
    $caminhoArquivo = "certificados/" . $nomeArquivo; 

    $output = $dompdf->output();
    file_put_contents($caminhoArquivo, $output);

    $sql = "INSERT INTO Certificados (nome, curso, data_emissao, arquivo_url) VALUES (:nome, :curso, NOW(), :arquivo_url)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nome' => $nome,
        'curso' => $curso,
        'arquivo_url' => $caminhoArquivo
    ]);

    if ($download === 'true') {
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename='{$nomeArquivo}'");
        readfile($caminhoArquivo);
    } else {
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename='{$nomeArquivo}'");
        readfile($caminhoArquivo);
    }
}
?>