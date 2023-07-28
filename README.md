README

Integração com o servidor usando cURL (Apache2) - WebFileServer

Este repositório fornece uma solução simples para a integração com o servidor servidor linux utilizando montagem NFS, para ser usado como WebFileServer da  Neste guia, você aprenderá como utilizar cURL para interagir com os arquivos de delete.php, move.php e upload.php, que são responsáveis por excluir, mover e enviar arquivos, respectivamente. Lembre-se de que os nomes de pastas, arquivos e endereços IP mencionados são exemplos e devem ser substituídos pelos seus próprios.

Requisitos

cURL instalado no seu sistema. Geralmente, cURL já está disponível na maioria das distribuições Linux e macOS. Para Windows, você pode instalá-lo facilmente seguindo as instruções no site oficial do cURL (https://curl.se/windows/).
Uso do cURL para interagir com o servidor WebFileServer

Excluir Arquivos (delete.php)
Para excluir um arquivo específico no servidor, utilize o seguinte comando cURL:

curl -X POST -F "caminho_arquivo=<caminho-do-arquivo-a-excluir>" <URL-do-servidor>/delete.php

Substitua <caminho-do-arquivo-a-excluir> pelo caminho completo do arquivo que você deseja excluir. Por exemplo, se quiser excluir o arquivo "exemplo.txt" na pasta "arquivos/processados", você deve utilizar:

curl -X POST -F "caminho_arquivo=arquivos/processados/exemplo.txt" <URL-do-servidor>/delete.php

Mover Arquivos (move.php)
Para mover um arquivo de uma pasta para outra no servidor, utilize o seguinte comando cURL:

curl -X POST -F "origem=<caminho-da-pasta-de-origem>" -F "destino=<caminho-da-pasta-de-destino>" <URL-do-servidor>/move.php

Substitua <caminho-da-pasta-de-origem> pelo caminho completo da pasta de origem e <caminho-da-pasta-de-destino> pelo caminho completo da pasta de destino. Por exemplo, se você deseja mover o arquivo "documento.txt" da pasta "arquivos/envio" para a pasta "arquivos/processados", utilize:

curl -X POST -F "origem=arquivos/envio/documento.txt" -F "destino=arquivos/processados" <URL-do-servidor>/move.php

Enviar Arquivos (upload.php)
Para enviar um arquivo para o servidor, utilize o seguinte comando cURL:

curl -X POST -F "arquivo=@<caminho-do-arquivo-local>" -F "pasta_destino=<caminho-da-pasta-de-destino-no-servidor>" <URL-do-servidor>/upload.php

Substitua <caminho-do-arquivo-local> pelo caminho completo do arquivo que você deseja enviar a partir do seu sistema local e <caminho-da-pasta-de-destino-no-servidor> pelo caminho completo da pasta de destino no servidor. Por exemplo, para enviar o arquivo "relatorio.pdf" da sua área de trabalho para a pasta "arquivos/envio" no servidor, utilize:

curl -X POST -F "arquivo=@/caminho/da/sua/area-de-trabalho/relatorio.pdf" -F "pasta_destino=arquivos/envio" <URL-do-servidor>/upload.php

Considerações Finais
Lembre-se de que os comandos cURL descritos acima são apenas exemplos genéricos. Certifique-se de substituir os caminhos e informações relevantes pelos valores específicos do seu servidor e da sua configuração. Além disso, antes de realizar qualquer ação de exclusão ou movimentação de arquivos, tenha certeza de que você possui as permissões adequadas no servidor para executar essas operações.
