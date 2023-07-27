<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Upload Arquivos</title>
  <style>
    body {
      background-color: #f1f1f1;
      font-family: Arial, sans-serif;
      text-align: center;
    }

    h1 {
      color: #333;
    }

    .upload-form {
      margin: 20px auto;
      width: 300px;
      padding: 20px;
      background-color: #fff;
      border-radius: 4px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .upload-form label {
      display: block;
      margin-bottom: 10px;
      color: #333;
      font-weight: bold;
    }

    .upload-form input[type="file"] {
      margin-bottom: 10px;
    }

    .upload-form input[type="submit"] {

padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .upload-form input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .message {
      margin-top: 20px;
      font-weight: bold;
    }

    .error {
      color: #ff0000;
    }
  </style>
</head>
<body>
  <h1>Upload de Arquivos</h1>
  <div class="upload-form">
    <form method="post" enctype="multipart/form-data">
      <label for="arquivos">Selecione um ou mais arquivos:</label>
      <input type="file" name="arquivos[]" multiple required>
      <input type="submit" value="Enviar Arquivos">
    </form>
<?php
// Usuário e senha permitidos para o upload
$allowedUser = 'XXX';
$allowedPassword = 'XXX';

// Verifica se as credenciais de autenticação estão corretas
if (
    !isset($_SERVER['PHP_AUTH_USER']) ||
    $_SERVER['PHP_AUTH_USER'] !== $allowedUser ||
    $_SERVER['PHP_AUTH_PW'] !== $allowedPassword
) {
    header('WWW-Authenticate: Basic realm="Autenticação necessária"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Acesso não autorizado.";
    exit;
}

$uploadDirectory = '<DIRECTORY>';

function isValidUploadFile($filename) {
    // Lista de extensões permitidas para upload
    $allowedExtensions = array('txt', 'xml');

    // Obtém a extensão do arquivo
    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Verifica se a extensão está na lista de permitidas
    return in_array($fileExtension, $allowedExtensions);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['arquivos'])) {
    $numArquivos = count($_FILES['arquivos']['name']);

    for ($i = 0; $i < $numArquivos; $i++) {
        $nomeArquivo = $_FILES['arquivos']['name'][$i];
        $caminhoCompleto = $uploadDirectory . $nomeArquivo;
        $fileExtension = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

        // Verifica se a extensão do arquivo é .txt ou .xml
        if (!isValidUploadFile($nomeArquivo)) {
            echo "<p class='message error'>Extensão inválida para o arquivo $nomeArquivo.</p>";
            continue;
        }

        if (move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $caminhoCompleto)) {
            echo "<p class='message'>Arquivo $nomeArquivo enviado com sucesso!</p>";
        } else {
            echo "<p class='message error'>Ocorreu um erro ao enviar o arquivo $nomeArquivo.</p>";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<p class='message error'>Nenhum arquivo selecionado.</p>";
}
?>
  </div>
</body>
</html>
