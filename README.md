# rede-magic-v2

- Utilizado o php laravel na versão 7.0 com o PHP 7.3 a base de dados o MariaDB.

- A coleção do Postman esta na pasta Postman/

A proposta do projeto é um crud básico em API-rest utilizando o framework laravel.
Tive um duvida a respeito de atores e diretor ser uma tabela diferenciada que o filme, 
Foram criados as Models e Controllers de Filmes, Atores e Diretores e Classificação. Criado o relacionamento dentre eles.
Para o desenvolvimento de front-end o usuário podera fazer um selectbox de multipla escolha tanto de atores e/ou diretor.
A parte de classificação pode ser implentada para a votação na tela de listagem dos filmes. Procurei polir a parte de backend.
Criei uma validação de campos obrigatórios.
*Acrescentado o upload de imagem.

Para se start o projeto é preciso configurar o .env com a base de dados de mysql obedecendo alguns parametros e se atentando ao campo usuario e senha.
no terminal acessar a pasta do projeto e utilizar o comando "ph artisan migrate" para se criar as tabelas necessárias. e para roda-lo localmente utilizar-se
o "php artisan serve" para realizar o teste dos metodos implementados.
Ira em anexo os collections do postman para que se faça mais agil.

