<?php 


$db = new PDO('sqlite:' . __DIR__ . '/estabelecimentos.db');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// Filtro por tipo
$tipoFiltro = $_GET['categoria'] ?? '';

$tipos = ['Farmácia', 'Supermercado','Postos','Alimentação',
'Saúde','Serviços','Compras','Casa e Construção','Beleza e Bem-estar','Educação','Lazer e Turismo'];


if ($tipoFiltro && in_array($tipoFiltro, $tipos)) {
    $stmt = $db->prepare("SELECT * FROM estabelecimentos WHERE categoria = :categoria ORDER BY nome");
    $stmt->execute([':categoria' => $tipoFiltro]);
    $estabelecimentos = $stmt->fetchAll();
} else {
    $estabelecimentos = $db->query("SELECT * FROM estabelecimentos ORDER BY categoria, nome")->fetchAll();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo rand() ?>">
    <link rel="shortcut icon" href="favicon.ico" />
    <title>Guia local - Novo Cruzeiro </title>
</head>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const input = document.getElementById("pesquisa");
            const cards = document.querySelectorAll(".card");

            input.addEventListener("input", function () {
                const termo = input.value.toLowerCase();

                cards.forEach(card => {
                    const textoCard = card.innerText.toLowerCase();

                    if (textoCard.includes(termo)) {
                        card.style.display = "block";
                    } else {
                        card.style.display = "none";
                    }
                });
            });
        });
        </script>

<body>
    <div class="cabecalho">
        <h1>Guia Local - Novo Cruzeiro</h1>

        <h3>Comércios da cidade</h3>
    </div>
   
    <div class="categoria">
         <input type="text" id="pesquisa" placeholder="Pesquisar" >
        <h3>Categorias:</h3>
        
            <div class="parte-categoria">
                
                        <a href="?" <?php echo !$tipoFiltro ? 'class="ativo"' : '' ?>>Todos</a>
                        <?php foreach ($tipos as $categoria): ?>
                            <a href="?categoria=<?php echo urlencode($categoria); ?>" <?php echo $tipoFiltro === $categoria ? 'class="ativo"' : ''; ?>>
                                <?php echo $categoria; ?>
                            </a>
                    <?php endforeach ?>
                
</div>

   

    </div>

    <div class="Comercios">

<?php if (empty($estabelecimentos)): ?>
        <p class="vazio">Nenhum estabelecimento encontrado.</p>
    <?php else: ?>
        <?php foreach ($estabelecimentos as $estabelecimento): ?>
            <div class="card">
                <div class="card-header">
                    <h2><?php echo $estabelecimento['nome']; ?></h2>
                </div>
                <span class="badge"><?php echo $estabelecimento['categoria']; ?></span>

                <hr>
              
                <p class="info"><?php echo $estabelecimento['endereco']; ?></p>
                <?php if ($estabelecimento['telefone']): ?>
                    <p class="info"><?php echo $estabelecimento['telefone']; ?></p>
                <?php endif ?>
                <?php if ($estabelecimento['horario']): ?>
                    <p class="info"><?php echo $estabelecimento['horario']; ?></p>
                <?php endif ?>
                 <?php if ($estabelecimento['link'] != '#'): ?>
                    <a class="info" href="<?php echo $estabelecimento['link']; ?>" target="_blank">Acesse</a>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    <?php endif ?>



</div>

        <div class = "rodape" >
                <p>  ©2026 Guia Local - Novo Cruzeiro.Todos os direitos reservados.</p> 
            </div> 
        </body>

            </html>