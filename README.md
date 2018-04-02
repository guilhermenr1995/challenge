## Challenge S2IT

## Descrição
Seu cliente recebe dois modelos XML de seu parceiro. Essa informação deve estar disponível tanto para o sistema Web quanto o App mobile.

## Desafio
Criar uma aplicação com Symfony2 para fazer upload manualmente dos XML's citados, e ter a opção de processá-los. Fazer com que a informação processada esteja disponível via API REST.


## Instalação

* Clone este repositório para o diretório desejado;

Crie um arquivo `parameters.yml` com base no arquivo `app/config/parameters.yml.dist` e insira os parâmetros necessários para fazer a conexão com o banco de dados;

    parameters:
	    database_host: 127.0.0.1
	    database_port: ~
	    database_name: 'database_name'
		database_user: 'database_user'
	    database_password: 'database_password'


Após isso, acesse o diretório do projeto clonado em seu terminal, e digite os seguintes comandos:

    > composer update
    > php app/console doctrine:database:create
    > php app/console doctrine:schema:update --force
   
Agora, basta executar o comando para executar a aplicação:

    > php app/console server:run
    
Com isso, a aplicação já estará disponível, inclusive a documentação da API no endereço `/api/doc`.
