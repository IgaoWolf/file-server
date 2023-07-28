<?php
if (isset($_POST['caminho_arquivo'])) {
    $caminho_arquivo = $_POST['caminho_arquivo'];

    // Caminho completo para o arquivo a ser excluído
    // Full path to the file to be deleted.
    
    $filePath = "/var/www/html/XXX/" . $caminho_arquivo;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "Arquivo excluído com sucesso!";
        } else {
            echo "Não foi possível excluir o arquivo.";
        }
    } else {
        echo "Arquivo não encontrado.";
    }
} else {
    echo "Parâmetro inválido. Certifique-se de enviar o campo 'caminho_arquivo'.";
}
?>
