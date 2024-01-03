# API - Sistema Gerenciamento de Livrarias - SPASSU

### Ambiente Docker

* PHP:8.1 - FPM
* MYSQL:8.0.16
* NGINX:latest

### Pré-Requisitos


* [Git](https://git-scm.com)
* [Docker](https://www.docker.com/)
* [Docker-compose](https://docs.docker.com/engine/reference/commandline/compose/)


### Instalação

1 - Clonando o repositório e configurando as variaveis de ambiente

    ```
    git clone git@github.com:evertonsena/book-store-api-spassu.git
    ```

O comando acima fará o clone do ambiente em docker e do projeto API [Book Store API Spassu](https://github.com/evertonsena/book-store-api-spassu)
    
Antes de rodar o projeto você deverá criar o arquivo .env, para isso basta gerar a partir do arquivo de exemplo:

    ```
    cp .env.example .env
    ```


2 - Construindo o container docker e iniciando o ambiente


    ```
    docker-compose up --build
    ```

3 - Iniciando o container depois de já ter feito o build 

    ```
    docker-compose up -d
    ```

Parando o docker-compose em execução: 

    ```
    docker-compose down
    ```
    
Para verificar o status dos containers
    
    ```
    docker-compose ps
    ```    
    
Para exibir os logs dos containers
    
    ```
    docker-compose logs
    ```    
    
Para rodar os testes unitários
    
    ```
    docker-compose exec php php artisan test
    ```    
    
4 - Acessando o sistema

* Poderá acessar o sistema através do browser no endereço: [http://localhost:9999](http://localhost:9999) (valor default que pode ser alterado)
* E acessar o banco de dados através da porta: 33099 (valor default que pode ser alterado)

5 - Acessando a documentação do sistema

* Para visualizar a documentação acesse: [http://localhost:9999/api/documentation](http://localhost:9999/api/documentation)