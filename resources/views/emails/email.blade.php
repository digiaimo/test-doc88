<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificação de Compra</title>
</head>
<body style="background-color: #162630">
    <div style="align-items: center; text-align: center; margin: 5%">
        <img src="https://www.comerc.com.br/hs-fs/hubfs/2x-ComercEnergia_Logo002.png?width=400&name=2x-ComercEnergia_Logo002.png" alt="" sizes="" srcset="">
        <h1 style="color: #fff">Olá, {{ $data['name'] }}</h1>
        <p style="color: #fff">Produto: {{ $data['product_name'] }}</p>
        <p style="color: #fff">Valor: {{ $data['product_price'] }}</p>
    </div>
</body>
</html>