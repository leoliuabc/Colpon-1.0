<?php
    header('HTTP/1.1 404 Not Found');
    header("status: 404 Not Found");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
		<div class="container">
		    <div class="content">
		        <div class="title">Sua busca por "{{$store_name}}" não obteve nenhum resultado.</div>
		        <p>Tente buscar pelo nome ou parte do nome da loja onde deseja comprar. Exemplo: "submarino", "magazine", "ameri" etc.</p>
		    </div>
		</div>
	</body>
</html>