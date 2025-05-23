<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title><?= (isset($title)) ? "ERP Montink - $title" : 'ERP Montink' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <!-- Importa todos os CSS automaticamente -->
    <?php
    foreach (glob(__DIR__ . '/../css/*.css') as $css) {
        $href = Router::baseUrl('/resources/css/' . basename($css));

        echo "<link rel='stylesheet' href='$href'>\n";
    }
    ?>

</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Montink</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= (Router::getPath() == '/') ? 'active' : '' ?>" aria-current="page" href="<?= Router::baseUrl('/') ?>">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(Router::getPath(), 'produtos') ? 'active' : '' ?>" href="<?= Router::baseUrl('/produtos') ?>">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= str_contains(Router::getPath(), 'pedidos') ? 'active' : '' ?>" href="<?= Router::baseUrl('/pedidos') ?>">Pedidos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Renderiza o conteúdo da view específica -->
    <?= $content ?>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    <!-- Importa todos os JS automaticamente -->
    <?php
    foreach (glob(__DIR__ . '/../js/*.js') as $js) {
        $src = Router::baseUrl('/resources/js/' . basename($js));

        echo "<script src='$src'></script>\n";
    }
    ?>
</body>

</html>