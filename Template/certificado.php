<?php
$nome = $nome ?? 'Nome Padrão';
$curso = $curso ?? 'Curso Padrão';
$data_emissao = $data_emissao ?? date('Y-m-d');

echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Certificado</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .certificado-container { display: flex; justify-content: space-between; }
        .certificado { border: 5px double black; padding: 20px; }
        .certificado-info { text-align: left; }
    </style>
</head>
<body>
    <div class='certificado-container'>
        <div class='certificado'>
            <h1>Certificado de Conclusão</h1>
            <p>Este certifica que <strong>$nome</strong> completou o curso <strong>$curso</strong>.</p>
            <p>Data: $data_emissao</p>
        </div>
        <div class='certificado-info'>
            <img src='imagens/R.png' alt='Logo'> 
        </div>
    </div>
</body>
</html>
";
?>