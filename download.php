<?php
// Usuário e senha para autenticação
// User and password for authentication
$validUser = 'XXXX';
$validPassword = 'XXXX';

// Verifica se as credenciais de autenticação estão corretas
// Check if authentication credentials are correct
if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] !== $validUser || $_SERVER['PHP_AUTH_PW'] !== $validPassword) {
    header('WWW-Authenticate: Basic realm="Autenticação necessária"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Acesso não autorizado.";
    exit;
}

// Diretório base onde os arquivos estão localizados
// Base directory where the files are located
$baseDirectory = '/(<DIRECTORY>)/';

// Verifica se o parâmetro "file" foi enviado via GET
// Checks if the "file" parameter was sent via GET
if (isset($_GET['file'])) {
    // Get the name of the requested file
    // Obtém o nome do arquivo solicitado
    $filename = $_GET['file'];

    // Monta o caminho completo para o arquivo
    // Assemble the full path to the file
    $filePath = $baseDirectory . $filename;

    // Verifica se o arquivo existe e é legível
    // Check if the file exists and is readable
    if (file_exists($filePath) && is_readable($filePath) && strpos(realpath($filePath), $baseDirectory) === 0) {
        // Define o tipo MIME do arquivo
        $fileMimeType = mime_content_type($filePath);

        // Envia os cabeçalhos apropriados para o download
        // Send the appropriate headers to the download
        header('Content-Type: ' . $fileMimeType);
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        // Envia o arquivo para o cliente
        // Send the file to the client
        readfile($filePath);
        exit;
    } else {
        header('HTTP/1.0 404 Not Found');
        echo "Arquivo não encontrado ou não pode ser lido.";
        exit;
    }
} else {
    header('HTTP/1.0 400 Bad Request');
    echo "Parâmetro 'file' não foi fornecido.";
    exit;
}
?>