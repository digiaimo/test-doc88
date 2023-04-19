<p align="center"><a href="" target="_blank"><img src="https://www.comerc.com.br/hs-fs/hubfs/2x-ComercEnergia_Logo002.png?width=400&name=2x-ComercEnergia_Logo002.png" width="300" alt="Laravel Logo"></a></p>


## Cadastro de Clientes, Produtos e Compras

Este é um projeto de cadastro de clientes, produtos e compras desenvolvido em [PHP] usando [Laravel].

Funcionalidades
Cadastro de clientes: nome, endereço, telefone, e-mail
Cadastro de produtos: nome, preço, foto
Cadastro de compras: cliente, produtos
Listagem de clientes, produtos e compras
Edição e exclusão de clientes, produtos e compras


## Pré-requisitos

- [Docker] <a href="https://docs.docker.com/">Documentação do Docker</a>

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
3. Copie o arquivo ```.env.example``` para ```.env```.

4. Execute ```./vendor/bin/sail up -d``` para baixar as dependências e subir os conteiners e desbloquear o terminal;

5. Execute `./vendor/bin/sail artisan key:generate` para gerar a APP_KEY no seu `.env`

6. Execute `./vendor/bin/sail artisan migrate --seed` para criar as tabelas no banco de dados e alimentá-la com dados fictícios;

7. Caso queira testar o envio de e-mail para novas compras, será necessário adicionar as credenciais de um servidor SMTP no seu `.env`. Uma sugestão de serviço para os testes é [MailTrap](https://mailtrap.io/). 

8. Para rodar os testes é necessario rodar o seguinte comando: ```./vendor/bin/sail test```

## Passos para testar a API

- Recomendado usar a <a href="https://docs.insomnia.rest/">Documentação do Insomnia</a>
## Cliente

- `POST api/customer` criar um cliente 
    - headers: `Content-Type: application/json`
    - payload: `{name: string, email: string, phone: number, address: string, complement: string, district: string, cep: string, date_of_birth: date}`
    - returns: `{informações do cliente cadastrado}`

- `PUT api/customer/{id}` atualizar informações de um cliente 
    - headers: `Content-Type: application/json`
    - payload: `{name: string,`
    - returns: `{status}`

- `GET api/customer/{id}` verificar um cliente 
    - headers: `Content-Type: application/json`
    - returns: `{informações do cliente pesquisado}`

- `DELETE api/customer/{id}` remover um cliente 
    - headers: `Content-Type: application/json`
    - returns: `{status}`

## Produtos

- `POST api/product` cadastrar um novo produto
    - headers: `Content-Type: application/json`
    - payload: `{name: string, price: float, photo: file}`
    - returns: `{informações do produto cadastrado}`

- `POST api/product/{id}` atualizar um produto
    - headers: `Content-Type: application/json`
    - payload: `{price: float}`
    - returns: `{status}`

- `GET api/product/{id}` verificar um produto
    - headers: `Content-Type: application/json`
    - returns: `{informações do produto pesquisado}`

- `DEELETE api/product/{id}` remover um produto
    - headers: `Content-Type: application/json`
    - returns: `{status}`

## Compras

- `POST api/acquisition` cadastrar uma nova compra
    - headers: `Content-Type: application/json`
    - payload: `{customer_id: number, product_id: number}`
    - returns: `{informações do produto comprado com informações do cliente que comprou}`

- `GET api/acquisition/{id}` pesquisar uma compra
    - headers: `Content-Type: application/json`
    - returns: `{informações do produto comprado com informações do cliente que comprou}`


- `DELETE api/acquisition/{id}` remover uma compra
    - headers: `Content-Type: application/json`
    - returns: `{status}`


