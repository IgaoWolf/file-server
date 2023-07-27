<?php
$baseDirectory = '<CAMINHO DO DIRETORIO>';

function listarArquivos($diretorio) {
    // Verifica se o diretório informado está dentro do escopo permitido
    // Checks if the specified directory is within the allowed scope
    if (strpos($diretorio, $GLOBALS['baseDirectory']) !== 0) {
        echo "O diretório $diretorio não é permitido.";
        return;
    }

    $itens = scandir($diretorio);

    if ($itens !== false && count($itens) > 0) {
        echo "<ul>";

        foreach ($itens as $item) {
            if ($item !== '.' && $item !== '..') {
                $caminhoItemCompleto = realpath($diretorio . '/' . $item);

                // Verifica se o caminho completo está dentro do escopo permitido
                // Checks if the full path is within the allowed scope
                if (strpos($caminhoItemCompleto, $GLOBALS['baseDirectory']) !== 0) {
                    continue;
                }

                // Se não houver barras no caminho, exibe o item
                // If there are no slashes in the path, display the item
                if (strpos($item, '/') === false) {
                    if (is_dir($caminhoItemCompleto)) {
                        // Exibe o link para a pasta
                        echo "<li><a href='arquivos.php?dir=" . urlencode($caminhoItemCompleto) . "'>$item/</a></li>";
                    } else {
                        // Obtém a extensão do arquivo para uso no download
                        $extensao = pathinfo($caminhoItemCompleto, PATHINFO_EXTENSION);
                        $nome = pathinfo($caminhoItemCompleto, PATHINFO_FILENAME);

                        // Exibe o link para o arquivo, apontando para o download.php
                        // Displays the link to the file, pointing to download.php
                        $downloadLink = "download.php?file=" . urlencode($item);
                        echo "<li><a href='$downloadLink'>$item</a></li>";
                    }
                }
            }
        }

        echo "</ul>";
    } else {
        echo "<p>Nenhum arquivo ou pasta encontrado.</p>";
    }
}

function mostrarCaminhoAtual($caminho) {
    $caminhoExibido = str_replace($GLOBALS['baseDirectory'], '', $caminho);
    $pastas = explode('/', $caminhoExibido);
    $pathAcumulado = '';

    echo "<p>Caminho Atual: <a href='arquivos.php'>Home</a> / ";

    foreach ($pastas as $pasta) {
        $pathAcumulado .= $pasta . '/';

        if (!empty($pasta)) {
            echo "<a href='arquivos.php?dir=" . urlencode($GLOBALS['baseDirectory'] . $pathAcumulado) . "'>$pasta</a> / ";
        }
    }

    echo "</p>";
}

if (isset($_GET['dir'])) {
    $pastaSelecionada = $_GET['dir'];

    // Limpa o valor do parâmetro para evitar possíveis ataques
    // Clears the parameter value to avoid possible attacks
    $pastaSelecionada = realpath($pastaSelecionada);

    // Verifica se o diretório selecionado está dentro do escopo permitido
    // Checks if the selected directory is within the allowed scope
    if (is_dir($pastaSelecionada) && strpos($pastaSelecionada, $baseDirectory) === 0) {
        echo "<h1>Lista de Arquivos e Pastas para Download</h1>";

        if (substr($pastaSelecionada, 0, strlen($baseDirectory)) === $baseDirectory) {
            mostrarCaminhoAtual($pastaSelecionada);
        }

        listarArquivos($pastaSelecionada);
    } else {
        echo "O diretório $pastaSelecionada não é permitido.";
    }
} else {
    echo "<h1>Lista de Arquivos e Pastas para Download</h1>";
    listarArquivos($baseDirectory);
}
?>