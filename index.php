<?php

use app\CSVConverter;

require __DIR__ .'/Converter.php';

$comercios = [];

$fileContent = file('comercio.csv');

if (count($fileContent) == 0) {
    exit('Arquivo vazio');
}

foreach($fileContent as $content) {
    $linha = explode(';', $content);
    $comercios[] = new CSVConverter(
        nome:$linha[0],
        categoria:$linha[4], 
        telefone:$linha[1], 
        endereco:$linha[2], 
        link: trim($linha[3]), 
        horario: trim($linha[5])
    );
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="cabecalho">
        <h1>Guia Local - Novo Cruzeiro</h1>
        
        <h3>Comércios da cidade</h3>
    </div>
    <div class="parte-categoria">
        <h3>Categorias:</h3>
        <div class="categoria">
            <hr>
            <input type="submit" value="Todos">
            <input type="submit" value="Restaurantes">
            <input type="submit" value="Farmácias">
            <input type="submit" value="Lojas">
            <input type="submit" value="Serviços">
            <input type="submit" value="Supermercados">
        </div>
    </div>

    <div class="Comercios">
        
    <?php
            
        foreach ($comercios as $chave => $data) {
            if ($chave != 0) {
                
                echo '<div class="comercio">';
                    echo "<h2>{$data->nome}</h2>";
                    echo "<h4>{$data->categoria}</h4>";
                    echo '<hr id="row">';
                    echo "<address>{$data->endereco}</address>";
                    echo "<p>{$data->telefone}</p>";
                    echo "<p>{$data->horario}</p>";
                    echo "<a href='{$data->link}' target='_blanck'>link</a>";
                      
                echo  '</div>';

            }      

        }

    ?>
        
    </div>

    <div class="rodape">
        <p>© 2026 Guia Local - Novo Cruzeiro. Todos os direitos reservados.</p>
    </div>
</body>

</html>