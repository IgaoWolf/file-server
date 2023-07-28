<?php
if (isset($_POST['origem']) && isset($_POST['destino'])) {
    $origem = $_POST['origem'];
    $destino = $_POST['destino'];

    // Caminhos completos para as pastas de origem e destino
    $sourcePath = "/var/www/html/XXX/" . $origem;
    $destinationPath = "/var/www/html/XXX/" . $destino;

    // Obter o nome do arquivo a partir do caminho da origem
    $fileName = basename($sourcePath);

    if (file_exists($sourcePath)) {
        if (rename($sourcePath, $destinationPath . "/" . $fileName)) {
            echo "Arquivo movido com sucesso!";
        } else {
            echo "Não foi possível mover o arquivo.";
        }
    } else {
        echo "Arquivo de origem não encontrado.";
    }
} else {
    echo "Parâmetros inválidos. Certifique-se de enviar os campos 'origem' e 'destino'.";
}
?>
