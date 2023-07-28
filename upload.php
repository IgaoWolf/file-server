<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['arquivo']) && isset($_POST['pasta_destino'])) {
        $pasta_destino = $_POST['pasta_destino'];
        $tempFile = $_FILES["arquivo"]["tmp_name"];
        $targetDir = "/var/www/html/XXX/temp/";
        $targetFile = $targetDir . basename($_FILES["arquivo"]["name"]);

        // Move o arquivo para a pasta temporária
        if (move_uploaded_file($tempFile, $targetFile)) {
            // Realiza outras validações ou processamentos, se necessário

            // Move o arquivo para o destino selecionado pelo usuário
            $destinationDir = "/var/www/html/XXX/" . $pasta_destino . "/";
            $destinationFile = $destinationDir . basename($_FILES["arquivo"]["name"]);

            if (rename($targetFile, $destinationFile)) {
                echo "O arquivo " . basename($_FILES["arquivo"]["name"]) . " foi enviado com sucesso para a pasta $pasta_destino.";
            } else {
                echo "Desculpe, não foi possível mover o arquivo para a pasta de destino.";
            }
        } else {
            echo "Desculpe, houve um erro ao enviar seu arquivo.";
        }
    } else {
        echo "Parâmetros inválidos. Certifique-se de enviar um arquivo e definir a pasta de destino.";
    }
} else {
    echo "Método de requisição inválido. Use POST para fazer o upload do arquivo.";
}
?>
