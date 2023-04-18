<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

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

