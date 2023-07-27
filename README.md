README

File Server Webservice

O File Server Webservice é um serviço desenvolvido em PHP que permite o armazenamento, download e listagem de arquivos em um servidor web configurado com o Apache2. Este serviço implementa autenticação básica para garantir que apenas usuários autorizados possam acessar e baixar os arquivos.

Requisitos
Antes de prosseguir com a instalação e configuração do File Server Webservice, certifique-se de que o seguinte esteja instalado no seu servidor:

Apache2: O servidor web Apache2 deve estar instalado e configurado corretamente no servidor.
PHP: O PHP é necessário para executar o código do webservice. Certifique-se de ter o PHP instalado e configurado com as extensões necessárias.

Instalação
Faça o download dos arquivos do webservice:

git clone https://github.com/IgaoWolf/file-server.git

Mova os arquivos upload.php, download.php e arquivos.php para o diretório do seu servidor web. Por exemplo, se estiver utilizando o Apache2 no Ubuntu, o diretório padrão é "/var/www/html/":

sudo cp upload.php download.php arquivos.php /var/www/html/

Certifique-se de que as permissões adequadas estejam definidas para os arquivos:

sudo chown www-data:www-data /var/www/html/upload.php /var/www/html/download.php /var/www/html/arquivos.php
sudo chmod 644 /var/www/html/upload.php /var/www/html/download.php /var/www/html/arquivos.php

Reinicie o servidor Apache2 para aplicar as alterações:

sudo service apache2 restart

Configuração
Antes de utilizar o serviço de File Server, é necessário configurar algumas variáveis nos arquivos upload.php, download.php e arquivos.php. Abra os arquivos e localize as seguintes linhas:

upload.php:
// Usuário e senha permitidos para o upload
$allowedUser = 'XXX';
$allowedPassword = 'XXX';

// Diretório de destino para o upload
$uploadDirectory = '<DIRECTORY>';
download.php:

php
// Usuário e senha para autenticação
$validUser = 'XXXX';
$validPassword = 'XXXX';

// Diretório base onde os arquivos estão localizados
$baseDirectory = '<DIRECTORY>';
arquivos.php:

$baseDirectory = '<CAMINHO DO DIRETORIO>';
Substitua 'XXX' pelos valores desejados para a autenticação básica. Defina um nome de usuário e uma senha seguros. Além disso, atualize '<DIRECTORY>' e '<CAMINHO DO DIRETORIO>' com o caminho absoluto do diretório no servidor onde deseja armazenar e buscar os arquivos.

Uso
Acesse o webservice através de um navegador ou um cliente HTTP (como curl).

Quando você acessar o endpoint /upload.php, será solicitado a inserir as credenciais de autenticação. Insira o nome de usuário e senha configurados anteriormente.
Se as credenciais forem corretas, você será redirecionado para a página de upload.
Selecione um ou mais arquivos para fazer o upload e clique em "Enviar Arquivos". Os arquivos serão armazenados no diretório especificado na configuração.
Para fazer o download de um arquivo, acesse o endpoint /download.php e informe o parâmetro file na URL com o nome do arquivo desejado.
O webservice verificará a autenticação e, se as credenciais estiverem corretas, o arquivo será enviado para download.
O webservice também inclui o arquivo arquivos.php, que lista todos os arquivos armazenados no servidor dentro do escopo permitido. Para acessar essa lista, basta fazer uma requisição GET para o endpoint /arquivos.php. Novamente, a autenticação será necessária para acessar essa lista.

Notas

Certifique-se de implementar medidas adequadas de segurança, como autenticação e autorização, para proteger o acesso aos arquivos no servidor.
Este é apenas um exemplo básico de um File Server Webservice e pode ser expandido e aprimorado para atender aos requisitos específicos do seu caso de uso.

Lembre-se de manter seus arquivos de configuração e senhas seguros e não compartilhe-os publicamente no repositório.

Se encontrar algum problema ou tiver alguma dúvida, sinta-se à vontade para abrir uma "issue" no repositório do projeto.
