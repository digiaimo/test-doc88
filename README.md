<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.comerc.com.br/hs-fs/hubfs/2x-ComercEnergia_Logo002.png?width=400&name=2x-ComercEnergia_Logo002.png" width="300" alt="Laravel Logo"></a></p>


## Cadastro de Clientes, Produtos e Compras

Este é um projeto de cadastro de clientes, produtos e compras desenvolvido em [PHP] usando [Laravel].

Funcionalidades
Cadastro de clientes: nome, endereço, telefone, e-mail
Cadastro de produtos: nome, preço, foto
Cadastro de compras: cliente, produtos
Listagem de clientes, produtos e compras
Edição e exclusão de clientes, produtos e compras


## Pré-requisitos

[PHP] instalada

[Docker] instalado

## Instalação

Para executar o projeto é recomendado que se use Docker. Caso prefira não usar, crie um banco de dados, siga as instruções a partir do passo 4 configurando as credenciais do banco no arquivo ```.env```.

## Passos usando o docker

1. Abra a pasta do projeto em um terminal;
2. Execute o código do bloco para criar a pasta ```vendor```
    ```sh
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
    ```
3. Execute ```./vendor/bin/sail up -d``` para baixar as dependências e subir os conteiners e desbloquear o terminal;

4. Clone o arquivo ```.env.example``` para ```.env```.

5. Execute `./vendor/bin/sail artisan key:generate` para gerar a APP_KEY no seu `.env`

6. Execute `./vendor/bin/sail artisan migrate --seed` para criar as tabelas no banco de dados e alimentá-la com dados fictícios;

7. Caso queira testar o envio de e-mail para novas compras, será necessário adicionar as credenciais de um servidor SMTP no seu `.env`. Para testes é recomendado usar o [MailTrap](https://mailtrap.io/). 

8. Para rodar os testes é necessario rodar o seguinte comando: ```./vendor/bin/sail test```

